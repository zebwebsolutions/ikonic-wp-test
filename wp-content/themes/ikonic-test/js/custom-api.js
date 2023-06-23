(function($) {
  // Send the request to the API endpoint
  $.ajax({
      url: customApiSettings.ajaxUrl + '?action=custom_api_projects',
      type: 'GET',
      dataType: 'json',
      headers: {
          'X-WP-Nonce': customApiSettings.nonce
      },
      success: function(response) {
        if (response.success) {
            // Check if a logged-in message is present in the response
            if (response.message) {
                // Display the logged-in message
                console.log(response.message);
            }
            // Process the API response data
            var projects = response.data;
            // Perform desired actions with the projects data
        } else {
            // Handle error response
            console.error(response.message);
        }
      },    
      error: function(jqXHR, textStatus, errorThrown) {
          // Handle AJAX error
          console.error(textStatus + ': ' + errorThrown);
      }
  });
})(jQuery);
