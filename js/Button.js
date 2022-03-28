function clickAdd() {
  window.location.href = '../pages/addProduct.html'
}

function clickMassDelete() {
  var checkboxes = document.querySelectorAll('input[name=selectedItem]:checked')
  var sku
  console.log('' + checkboxes.length)
  for (var i = 0; i < checkboxes.length; i++) {
    var chk = checkboxes[i].id
    sku = document.getElementById('sku' + chk).innerHTML
    rem = checkboxes[i].parentElement.id
    document.getElementById(rem).remove()
    deleteI(sku)
  }
}

function deleteI(sku) {
  var dataToBeSend = {
    text: '' + sku,
  }
  var dataJson = JSON.stringify(dataToBeSend)
  $.ajax({
    type: 'POST',
    dataType: 'json',
    data: dataJson,
    url: '../php/action/deletedata.php',
    success: function (resultText) {},
  }).fail(function () {
    console.log('Request failed:')
  })
}
