<!DOCTYPE html>
<html>
    <head>
    <title>Submit a form via AJAX</title>
      <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
		
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"> </script>
        <script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"> </script>
		
</head>
<body>
    <script>
        function onSuccess(data, status)
        {
            data = $.trim(data);
            $("#notification").text(data);
        }
  
        function onError(data, status)
        {
            // handle an error
        }        
  
        $(document).ready(function() {
            $("#submit").click(function(){
  
                var formData = $("#seniordesign").serialize();
  
                $.ajax({
                    type: "POST",
                    url: "seniordesign.php",
                    cache: false,
                    data: formData,
                    success: onSuccess,
                    error: onError
                });
  
                return false;
            });
        });
    </script>
  
    <!-- call ajax page -->
    <div data-role="page" id="seniordesign">
        <div data-role="header">
            <h1>Call Ajax</h1>
        </div>
  
        <div data-role="content">
            <form action="seniordesign.php" method="get" >
                <div data-role="fieldcontain">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" value=""  />
 
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" value=""  />
                    
                    <button data-theme="b" id="submit" type="submit">Submit</button>
                </div>
            </form>
        </div>
  
        <div data-role="footer">
            <h1>GiantFlyingSaucer</h1>
        </div>
    </div>
</body>
</html>