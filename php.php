<?php
function createForumPost($title, $body, $author) {
  // Set the request method and endpoint
  $method = 'POST';
  $endpoint = '/athtech/forum/posts';

  // Set the request body
  $data = array(
    'title' => $title,
    'body' => $body,
    'author' => $author
  );
  
  // Send the request
  $response = file_get_contents($endpoint, false, $context);

  // Return the response
  return $response;
}

// Example usage
$response = createForumPost('My First Post', 'Hello World!', 'john.doe');
echo $response;

// Create a comment request to the server and post it

function createForumComment($postId, $body, $author) {
    // Set the request method and endpoint
    $method = 'POST';
    $endpoint = '/athtech/forum/posts/' . $postId . '/comments';
  
    // Set the request body
    $data = array(
      'body' => $body,
      'author' => $author
    );
    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => $method,
        'content' => http_build_query($data),
      ),
    );
    $context  = stream_context_create($options);
  
    // Send the request
    $response = file_get_contents($endpoint, false, $context);
  
    // Return the response
    return $response;
  }
  
  // Example usage
  $response = createForumComment(42, 'Great post!', 'jane.doe');

?>

