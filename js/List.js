listPage()

function listPage() {
  var node = document.getElementById('list')

  var req = new XMLHttpRequest()
  req.onload = () => {
    var arry = JSON.parse(req.responseText)
    var arr = arry.item
    var len = arr.length
    for (var i = 0; i < len; i++) {
      node.innerHTML +=
        '<li id="item' +
        i +
        '" class= "item">' +
        '<input id="' +
        i +
        '" name ="selectedItem" class= "delete-checkbox" type="checkbox"/>' +
        '<div class="info">' +
        '<p id="sku' +
        i +
        '" >' +
        arr[i].sku +
        '</p>' +
        '<p id="nam' +
        i +
        '">' +
        arr[i].nam +
        '</p>' +
        '<p id="price' +
        i +
        '">' +
        arr[i].price +
        '$' +
        '</p>' +
        '<p id="typeinfo' +
        i +
        '"></p>' +
        '</div>' +
        '</li>'
    }
    for (var i = 0; i < len; i++) {
      var element = document.getElementById('typeinfo' + i)
      getDVD(arr[i].sku, element)
      getBook(arr[i].sku, element)
      getFurniture(arr[i].sku, element)
    }
  }
  req.open('GET', '../php/action/getdata.php')
  req.send()
}

function getDVD(sku, ele) {
  var rq = new XMLHttpRequest()
  rq.onload = () => {
    var ar = JSON.parse(rq.responseText)
    var arr = ar.dvd
    var l = arr.length
    for (var i = 0; i < l; i++) {
      if (arr[i].sku == sku) {
        ele.innerHTML = 'Size' + arr[i].size
      }
    }
  }
  rq.open('GET', '../php/action/getdata.php')
  rq.send()
}

function getBook(sku, ele) {
  var rq = new XMLHttpRequest()
  rq.onload = () => {
    var ar = JSON.parse(rq.responseText)
    var arr = ar.book
    var l = arr.length
    for (var i = 0; i < l; i++) {
      if (arr[i].sku == sku) {
        ele.innerHTML = 'Weight' + arr[i].weight
      }
    }
  }
  rq.open('GET', '../php/action/getdata.php')
  rq.send()
}

function getFurniture(sku, ele) {
  var rq = new XMLHttpRequest()
  rq.onload = () => {
    var ar = JSON.parse(rq.responseText)
    var arr = ar.furniture
    var l = arr.length
    for (var i = 0; i < l; i++) {
      if (arr[i].sku == sku) {
        ele.innerHTML =
          'Dimensions:' + arr[i].leng + 'x' + arr[i].height + 'x' + arr[i].width
      }
    }
  }
  rq.open('GET', '../php/action/getdata.php')
  rq.send()
}
