function filterTable(searchTerm) {
    var table = document.getElementById('personnelTable');
    var rows = table.getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        if (rows[i].classList.contains('table-row')) {
            var cells = rows[i].getElementsByTagName('td');
            var display = 'none';
            for (var j = 0; j < cells.length; j++) {
                var cellText = cells[j].textContent || cells[j].innerText;
                if (cellText.trim().toUpperCase().indexOf(searchTerm.trim().toUpperCase()) > -1) {
                    display = '';
                    break;
                }
            }
            rows[i].style.display = display;
        }
    }
}

function searchAndNavigate() {
    var personnelID = document.getElementById('SearchPersonnel').value.trim();
    var table = document.getElementById('personnelTable');
    var rows = table.getElementsByTagName('tr');
    var found = false;

    for (var i = 0; i < rows.length; i++) {
        var rowData = rows[i].getElementsByTagName('td');
        var display = 'none';
        if (rowData.length > 0 && rowData[0].textContent.trim() === personnelID) {
            display = '';
            found = true;
            window.location.href = 'admin_personnel_details.php?PersonnelID=' + personnelID;
            break;
        }
    }

    if (!found) {
        alert('Personnel not found.');
    }
}

function viewPersonnelDetails(personnelID) {
    window.location.href = 'admin_personnel_details.php?PersonnelID=' + personnelID;
}
