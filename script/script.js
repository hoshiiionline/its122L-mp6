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
    header(header: 'Refresh: 0; URL = pages/register.php');
}
