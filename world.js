document.addEventListener("DOMContentLoaded", () => {
    const lookupButton = document.getElementById("lookup");
    const resultDiv = document.getElementById("result");
  
    lookupButton.addEventListener("click", () => {
      // Get the user input (if any) from a text field
      const query = document.getElementById("country").value || ""; // Assuming there's an input field with id "country"
  
      const xhr = new XMLHttpRequest();
  
      xhr.open("GET", `world.php?country=${encodeURIComponent(query)}`, true);
  
      xhr.onload = function () {
        if (xhr.status === 200) {
          // Display the response in the result div
          resultDiv.innerHTML = xhr.responseText;
        } else {
          // Handle errors
          resultDiv.innerHTML = `Error: ${xhr.status} - ${xhr.statusText}`;
        }
      };
  
      xhr.onerror = function () {
        resultDiv.innerHTML = "An error occurred while fetching the data.";
      };
  
      xhr.send();
    });
  });
  