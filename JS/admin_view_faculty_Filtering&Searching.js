document.getElementById("SearchFaculty").addEventListener("input", function() {
    var facultyID = this.value;
    var dropdownValue = document.getElementById("departmentDropdown").value.toLowerCase();
    var table = document.getElementsByTagName("table")[0];
    var rows = table.getElementsByTagName("tr");

    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        if (cells[0].textContent.includes(facultyID) && (dropdownValue === "all" || cells[5].textContent.toLowerCase() === dropdownValue)) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
});

document.getElementById("departmentDropdown").addEventListener("change", function() {
    var dropdownValue = this.value.toLowerCase();
    var table = document.getElementsByTagName("table")[0];
    var rows = table.getElementsByTagName("tr");

    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        if (dropdownValue === "all" || cells[5].textContent.toLowerCase() === dropdownValue) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
});

function searchFaculty() {
    var facultyID = document.getElementById('SearchFaculty').value;
    var dropdownValue = document.getElementById("departmentDropdown").value.toLowerCase();
    var table = document.getElementsByTagName("table")[0];
    var rows = table.getElementsByTagName("tr");
    var found = false;

    if (facultyID !== '') {
        if (dropdownValue === "all") {
            window.location.href = 'admin_faculty_details.php?FacultyID=' + facultyID;
        } else {
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                if (cells[5].textContent.toLowerCase() === dropdownValue && cells[0].textContent === facultyID) {
                    found = true;
                    break;
                }
            }

            if (found) {
                window.location.href = 'admin_faculty_details.php?FacultyID=' + facultyID;
            } else {
                alert("Faculty not found");
            }
        }
    } else {
        alert('Please enter a valid Faculty ID.');
    }
}
