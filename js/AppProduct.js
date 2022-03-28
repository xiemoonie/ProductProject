function clickCancel() {
  window.location.href = '../index.html'
}

function pureLetter(txt) {
  var letters = /^[A-Za-z0-9., ]+$/
  if (txt.match(letters)) {
    return txt
  } else {
    alert('Please, submit required data')
    throw 'Cannot continue, text contains illegal characters'
  }
}

function changeFunc() {
  var selectBox = document.getElementById('productType')
  var selectedValue = selectBox.options[selectBox.selectedIndex].value

  if (selectedValue == 'DVD') {
    document.getElementById('form00').style.display = 'contents'
    document.getElementById('form01').style.display = 'none'
    document.getElementById('form02').style.display = 'none'
  }
  if (selectedValue == 'Furniture') {
    document.getElementById('form00').style.display = 'none'
    document.getElementById('form01').style.display = 'contents'
    document.getElementById('form02').style.display = 'none'
  }
  if (selectedValue == 'Book') {
    document.getElementById('form00').style.display = 'none'
    document.getElementById('form01').style.display = 'none'
    document.getElementById('form02').style.display = 'contents'
  }
}

function sendDataToServer() {
  var selectedType = $('#productType').val()

  console.log('SelectedType: ' + selectedType)

  var data = {
    itemType: selectedType,
    sku: pureLetter($('#sku').val()),
    name: pureLetter($('#name').val()),
    price: pureLetter($('#price').val()),
    ...(selectedType == 'DVD' && {
      size: pureLetter($('#size').val()),
    }),
    ...(selectedType == 'Furniture' && {
      height: pureLetter($('#height').val()),
      length: pureLetter($('#length').val()),
      width: pureLetter($('#width').val()),
    }),
    ...(selectedType == 'Book' && {
      weight: pureLetter($('#weight').val()),
    }),
  }

  var dataJson = JSON.stringify(data)

  console.log(dataJson)

  $.ajax({
    type: 'POST',
    dataType: 'json',
    data: dataJson,
    url: '../php/action/setDataNew.php',
    success: function (resultText) {
    },
  }).fail(function (jqXHR, textStatus) {
    alert('Please, provide the data of indicated type')
  })
}
