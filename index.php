<?php 
date_default_timezone_set('UTC');
?>
<html>
<body style="font-size: 14pt;">
Hello, <?php echo $_SERVER['REMOTE_ADDR']; ?>
<br>
It is now <?php echo date(DATE_RFC2822); ?>
<br>
Served to you by
<a href="http://nginx.org/">Nginx</a>,
running on a
<a href="http://rumpkernel.org">rump kernel</a>...
<br>
<?php
   require "predis/autoload.php";

   try {
      // This connection is for a remote server
      $redis = new Predis\Client(array(
         "scheme" => "tcp",
         "host" => "redis",
         "port" => 6379
      ));
   } catch (Exception $e) {
      echo "Couldn't connected to Redis";  
      die($e->getMessage());
   }
      
   // sets message to contain "Hello world"
   $redis->set('message', 'Hello world from Redis store');

   // gets the value of message
   $value = $redis->get('message');

   // Hello world
   print($value); 
?>
</body>
</html>