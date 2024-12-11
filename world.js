// Add an event listener for the "Lookup" button
document.addEventListener("DOMContentLoaded", () => {
    const lookupButton = document.getElementById("lookup");
    const resultDiv = document.getElementById("result");
  
    // Attach click event listener
    lookupButton.addEventListener("click", () => {
      // Get the user input (if any) from a text field
      const query = document.getElementById("country").value || ""; // Assuming there's an input field with id "country"
  
      // Create an XMLHttpRequest object
      const xhr = new XMLHttpRequest();
  
      // Set up the request (GET request with the query parameter)
      xhr.open("GET", `world.php?country=${encodeURIComponent(query)}`, true);
  
      // Define what happens when the request is successful
      xhr.onload = function () {
        if (xhr.status === 200) {
          // Display the response in the result div
          resultDiv.innerHTML = xhr.responseText;
        } else {
          // Handle errors
          resultDiv.innerHTML = `Error: ${xhr.status} - ${xhr.statusText}`;
        }
      };
  
      // Define what happens in case of an error
      xhr.onerror = function () {
        resultDiv.innerHTML = "An error occurred while fetching the data.";
      };
  
      // Send the AJAX request
      xhr.send();
    });
  });
  