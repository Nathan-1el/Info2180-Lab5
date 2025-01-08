document.addEventListener("DOMContentLoaded", () => {
    const lookupButton = document.getElementById("lookup");
    const resultDiv = document.getElementById("result");
  
    lookupButton.addEventListener("click", () => {
      
      const query = document.getElementById("country").value || ""; // Assuming there's an input field with id "country"
  
      const xhr = new XMLHttpRequest();
  
      xhr.open("GET", `world.php?country=${encodeURIComponent(query)}`, true);
  
      xhr.onload = function () {
        if (xhr.status === 200) {
          resultDiv.innerHTML = xhr.responseText;
        } else {
          
          resultDiv.innerHTML = `Error: ${xhr.status} - ${xhr.statusText}`;
        }
      };
  
      xhr.onerror = function () {
        resultDiv.innerHTML = "An error occurred while fetching the data.";
      };
  
      xhr.send();
    });

    const citiesButton = document.getElementById("cities");

    citiesButton.addEventListener("click",() =>{
      const query = document.getElementById("country").value || "";
      const xhr = new XMLHttpRequest();

      xhr.open("GET", `world.php?country=${encodeURIComponent(query)}&cities=true`, true);

      xhr.onload = function () {
        if (xhr.status === 200) {
         
          resultDiv.innerHTML = xhr.responseText;
        } else {
          
          resultDiv.innerHTML = `Error: ${xhr.status} - ${xhr.statusText}`;
        }
      };
  
      xhr.onerror = function () {
        resultDiv.innerHTML = "An error occurred while fetching the data.";
      };
  
      xhr.send();

    });
  });
  