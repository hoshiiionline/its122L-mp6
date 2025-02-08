function deleteUser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        fetch("../use_reg_api/api.php", {
            method: "DELETE",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "id=" + userId
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload(); // Refresh the page after deletion
        })
        .catch(error => console.error("Error:", error));
    }
}

function updateUser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        let formData = new FormData(this);
        let jsonData = {};
        formData.forEach((value, key) => { jsonData[key] = value; });
        
        fetch("../use_reg_api/api.php", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(jsonData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === "User updated successfully") {
                document.getElementById("notification").style.display = "block"; // Show success message
                setTimeout(() => {
                    window.location.href = "userlist.php"; // Redirect after 2 seconds
                }, 2000);
            } else {
                alert("Error: " + data.message); // Show error message if any
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while updating the user.");
        });
        
    }
}


document.getElementById("editForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent normal form submission
    
    let formData = new FormData(this);
    let jsonData = {};
    formData.forEach((value, key) => { jsonData[key] = value; });

    fetch("../use_reg_api/api.php", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(jsonData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === "User updated successfully") {
            document.getElementById("notification").style.display = "block"; // Show success message
            setTimeout(() => {
                window.location.href = "userlist.php"; // Redirect after 2 seconds
            }, 2000);
        } else {
            alert("Error: " + data.message); // Show error message if any
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while updating the user.");
    });
});