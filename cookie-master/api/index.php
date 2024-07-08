<?php
require 'vendor/autoload.php';
require 'config.php';

$app = new \Slim\App;

// CORS Middleware
$app->add(function ($request, $response, $next) {
    $response = $next($request, $response);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Handle OPTIONS requests
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

// Define the container for error handling (optional)
$container = $app->getContainer();
$container['errorHandler'] = function($container) {
    return function($request, $response, $exception) use ($container) {
        return $response->withStatus(500)
                        ->withHeader('Content-Type', 'application/json')
                        ->write(json_encode(['status' => 'error', 'message' => $exception->getMessage()]));
    };
};

// User Registration
$app->post('/register', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();

        $input = $request->getParsedBody();
        $name = $input['name'];
        $email = $input['email'];
        $password = $input['password'];
        $phoneNumber = $input['phoneNumber'];
        $address = $input['address'];
        $userType = $input['userType'];

        // Check if email already exists
        $checkEmail = $db->prepare("SELECT * FROM users WHERE email = :email");
        $checkEmail->bindParam(':email', $email);
        $checkEmail->execute();
        
        if ($checkEmail->rowCount() > 0) {
            return $response->withJson(['status' => 'failed', 'message' => 'Email already exists'])
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(400);
        }

        $sql = "INSERT INTO users (name, email, password, userType, address, phoneNumber) VALUES (:name, :email, :password, :userType, :address, :phoneNumber)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':userType', $userType);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->execute();

        error_log("User registered with email: $email and plain text password.");

        return $response->withJson(['status' => 'success'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(201);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    } catch (Exception $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'An unexpected error occurred'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// User Login
$app->post('/login', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();

        $input = $request->getParsedBody();
        $email = $input['email'];
        $password = $input['password'];

        // Check if email exists
        $checkUser = $db->prepare("SELECT * FROM users WHERE email = :email");
        $checkUser->bindParam(':email', $email);
        $checkUser->execute();

        $user = $checkUser->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            error_log("User not found for email: $email");
            return $response->withJson(['status' => 'failed', 'message' => 'Invalid email or password'])
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(401);
        }

        error_log("Fetched password for user $email: " . $user['password']);
        error_log("Provided password: $password");

        if ($password !== $user['password']) {
            error_log("Password verification failed for user: " . $email);
            return $response->withJson(['status' => 'failed', 'message' => 'Invalid password'])
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(401);
        }

        unset($user['password']);

        return $response->withJson(['status' => 'success', 'user' => $user])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
    } catch (PDOException $e) {
        error_log("PDOException: " . $e->getMessage());
        return $response->withJson(['status' => 'error', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    } catch (Exception $e) {
        error_log("Exception: " . $e->getMessage());
        return $response->withJson(['status' => 'error', 'message' => 'An unexpected error occurred'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// Create Job
$app->post('/createJob', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();

        $input = $request->getParsedBody();
        $title = $input['title'];
        $description = $input['description'];
        $location = $input['location'];
        $type = $input['type'];
        $salaryMin = $input['salaryMin'];
        $salaryMax = $input['salaryMax'];

        $sql = "INSERT INTO jobs (title, description, location, type, salaryMin, salaryMax) 
                VALUES (:title, :description, :location, :type, :salaryMin, :salaryMax)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':salaryMin', $salaryMin);
        $stmt->bindParam(':salaryMax', $salaryMax);
        $stmt->execute();

        return $response->withJson(['status' => 'success'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(201);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// Get all jobs
$app->get('/jobs', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();

        $sql = "SELECT * FROM jobs";
        $stmt = $db->query($sql);
        $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $response->withJson(['status' => 'success', 'jobs' => $jobs])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// Get job by ID
$app->get('/jobs/{id}', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();

        $id = $args['id'];

        $stmt = $db->prepare("SELECT * FROM jobs WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $job = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($job) {
            return $response->withJson(['status' => 'success', 'job' => $job])
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(200);
        } else {
            return $response->withJson(['status' => 'failed', 'message' => 'Job not found'])
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(404);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// Update Job
$app->put('/jobs/{id}', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();

        $id = $args['id'];
        $input = $request->getParsedBody();
        $title = $input['title'];
        $description = $input['description'];
        $location = $input['location'];
        $type = $input['type'];
        $salaryMin = $input['salaryMin'];
        $salaryMax = $input['salaryMax'];

        $sql = "UPDATE jobs SET title = :title, description = :description, location = :location, type = :type, salaryMin = :salaryMin, salaryMax = :salaryMax WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':salaryMin', $salaryMin);
        $stmt->bindParam(':salaryMax', $salaryMax);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $response->withJson(['status' => 'success'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// Delete Job
$app->delete('/jobs/{id}', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();

        $id = $args['id'];

        $sql = "DELETE FROM jobs WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $response->withJson(['status' => 'success'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// Add Review
$app->post('/reviews', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();
        
        $input = $request->getParsedBody();
        $userId = $input['userId'];
        $jobId = $input['jobId'];
        $company = $input['company'];
        $category = $input['category'];
        $rating = $input['rating'];
        $comment = $input['comment'];
        
        $sql = "INSERT INTO reviews (userId, jobId, company, category, rating, comment) 
                VALUES (:userId, :jobId, :company, :category, :rating, :comment)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':jobId', $jobId);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
        
        return $response->withJson(['status' => 'success'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(201);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// Get reviews by job ID
$app->get('/reviews/job/{jobId}', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();

        $jobId = $args['jobId'];
        $sql = "SELECT * FROM reviews WHERE jobId = :jobId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':jobId', $jobId);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $response->withJson(['status' => 'success', 'reviews' => $reviews])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// Update Review
$app->put('/reviews/{id}', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();
        
        $id = $args['id'];
        $input = $request->getParsedBody();
        $category = $input['category'];
        $rating = $input['rating'];
        $comment = $input['comment'];
        
        $sql = "UPDATE reviews SET category = :category, rating = :rating, comment = :comment WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $response->withJson(['status' => 'success'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// Delete Review
$app->delete('/reviews/{id}', function($request, $response, $args) {
    try {
        $db = new db();
        $db = $db->connect();
        
        $id = $args['id'];
        $sql = "DELETE FROM reviews WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $response->withJson(['status' => 'success'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 0);
        return $response->withJson(['status' => 'failed', 'message' => 'Database error'])
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(500);
    }
});

// Test route to ensure server is running
$app->get('/', function ($request, $response, $args) {
    return $response->withJson(['status' => 'API is running']);
});

$app->run();
