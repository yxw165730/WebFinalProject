function setDeletAction() {
    if(confirm("Are you sure want to delete these cars?")) {
        document.frmUser.action = "delete_car.php";
        document.frmUser.submit();
    }
}
  