var dataAreOk = true

function clickCancel() {
  window.location.href = '../index.html'
}

function pureLetter(elem, errorMessage) {
  var errorElem = $(elem + 'Elem')
  var txt = $(elem).val()
  var letters = /^[A-Za-z0-9., ]+$/

  if(txt.length === 0){
    errorElem.text('Please, submit required data')
    dataAreOk = false
  }else if (txt.match(letters)) {
    errorElem.text('')
    return txt
  } else {
    errorElem.text('Please, provide the data of indicated type')
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
    sku: pureLetter('#sku'),
    name: pureLetter('#name'),
    price: pureLetter('#price'),
    ...(selectedType == 'DVD' && {
      size: pureLetter('#size'),
    }),
    ...(selectedType == 'Furniture' && {
      height: pureLetter('#height'),
      length: pureLetter('#length'),
      width: pureLetter('#width'),
    }),
    ...(selectedType == 'Book' && {
      weight: pureLetter('#weight',  'please submit require data'),
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
        success: function (respuesta) {
          returnMainPage()
        }
      }
    )
  }
}
