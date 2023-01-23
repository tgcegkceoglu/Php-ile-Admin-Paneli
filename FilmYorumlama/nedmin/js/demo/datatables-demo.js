// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "language": {
      "lengthMenu": "Sayfada _MENU_ Kayıt Göster",
      "zeroRecords": "Eşlenen Kayıt Bulunamadı",
      "info": "_TOTAL_ Kayıttan _START_ - _END_ Arası Kayıtlar",
      "infoEmpty": "Kayıt Bulunamadı",
      "search": "Arama",
      "infoFiltered": "(_TOTAL_ Kayıttan _START_ - _END_ Arası Kayıtlar)"
  }
  });
} );

