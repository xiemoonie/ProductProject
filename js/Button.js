function clickAdd() {
  window.location.href = '../pages/addProduct.html'
}

function returnMainPage() {
  window.location.href = '../index.html'
}

function clickMassDelete() {
  var checkboxes = document.querySelectorAll('input[name=selectedItem]:checked')
  var sku
  var itemType
  console.log('' + checkboxes.length)
  for (var i = 0; i < checkboxes.length; i++) {
    var chk = checkboxes[i].id
    sku = document.getElementById('sku' + chk).innerHTML
    itemType = document.getElementById('itemType' + chk).innerHTML
    rem = checkboxes[i].parentElement.id
    document.getElementById(rem).remove()
    deleteI(sku, itemType)
  }
}

function deleteI(sku, itemType) {
  var dataToBeSend = {
    text: '' + sku,
    "itemType": itemType
  }

  var dataJson = JSON.stringify(dataToBeSend)
  $.ajax({
    type: 'POST',
    dataType: 'text',
    data: {
      eraseD: dataJson,
    },
    url: '../php/actions/deleteItem.php',
  })
}
