var dataAreOk = true

function clickCancel() {
  window.location.href = '../index.html'
}

function pureLetter(elem, errorMessage) {
  var errorElem = $(elem + 'Elem')
  var form2 = $('#form00')
  var form1 = $('#product_form')
  var txt = $(elem).val()
  var letters = /^[A-Za-z0-9., ]+$/
  if (txt.match(letters)) {
    errorElem.text('')
    return txt
  } else {
    errorElem.text(errorMessage)
    dataAreOk = false
  }
}

function changeFunc() {
  var selectBox = document.getElementById('productType')
  var selectedValue = selectBox.options[selectBox.selectedIndex].value

  if (selectedValue == 'DVD') {
    document.getElementById('form00').style.display = 'grid'
    document.getElementById('form01').style.display = 'none'
    document.getElementById('form02').style.display = 'none'
  }
  if (selectedValue == 'Furniture') {
    document.getElementById('form00').style.display = 'none'
    document.getElementById('form01').style.display = 'grid'
    document.getElementById('form02').style.display = 'none'
  }
  if (selectedValue == 'Book') {
    document.getElementById('form00').style.display = 'none'
    document.getElementById('form01').style.display = 'none'
    document.getElementById('form02').style.display = 'grid'
  }
}

function sendDataToServer() {
  var selectedType = $('#productType').val()

  console.log('SelectedType: ' + selectedType)

  dataAreOk = true

  var data = {
    itemType: selectedType,
    sku: pureLetter('#sku', 'please submit require data'),
    name: pureLetter('#name', 'please submit require data'),
    price: pureLetter('#price', 'please submit require data'),
    ...(selectedType == 'DVD' && {
      size: pureLetter('#size', 'please provide the right size'),
    }),
    ...(selectedType == 'Furniture' && {
      height: pureLetter('#height', 'please provide the right dimensions'),
      length: pureLetter('#length', 'please provide the right dimensions'),
      width: pureLetter('#width', 'please provide the right dimensions'),
    }),
    ...(selectedType == 'Book' && {
      weight: pureLetter('#weight', 'please provide the right weight'),
    }),
  }

  if (dataAreOk) {
    var dataJson = JSON.stringify(data)

    console.log(dataJson)

    $.ajax(
      {
        type: 'POST',
        dataType: 'text',
        data: {
          setD: dataJson,
        },
        url: '../php/actions/addItem.php',
      },
      function (respuesta) {
        returnMainPage()
      },
    )
  }
}
