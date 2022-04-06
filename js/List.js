listPage()

function generateItemHtml(i, itemType, sku, nam, price, extraHtml) {
  return (
    '<li id="item' +
    i +
    '" class= "item">' +
    '<input id="' +
    i +
    '" name ="selectedItem" class= "delete-checkbox" type="checkbox"/>' +
    '<div class="info">' +
    '<p id="itemType' +
    i +
    '" style="display:none;">' +
    itemType +
    '</p>' +
    '<p id="sku' +
    i +
    '" >' +
    sku +
    '</p>' +
    '<p id="nam' +
    i +
    '">' +
    nam +
    '</p>' +
    '<p id="price' +
    i +
    '">' +
    price +
    '$' +
    '</p>' +
    '<p id="typeinfo' +
    i +
    '">'+extraHtml+'</p>' +
    '</div>' +
    '</li>'
  )
}

function listPage() {
  var node = document.getElementById('list')

  var req = new XMLHttpRequest()
  req.onload = () => {
    var ar = req.responseText
    ar = JSON.parse(ar)
    var arr = ar.items
    var len = arr.length
    for (var i = 0; i < len; i++) {
      node.innerHTML +=
        generateItemHtml(
          i,
          arr[i].itemType,
          arr[i].sku,
          arr[i].name,
          arr[i].price,
         generateItemExtraHtml(arr[i]))
    }
  }
  req.open('GET', '../php/actions/getItem.php')
  req.send()
}

function generateItemExtraHtml(data) {
  switch (data.itemType.toLowerCase()) {
    case 'dvd': return getDVDHtml(data)
    case 'book': return getBookHtml(data)
    case 'furniture': return getFurnitureHtml(data)
  }
}

function getDVDHtml(data) {
  return 'Size' + data.size
}

function getBookHtml(data) {
  return 'Weight' + data.weight
}

function getFurnitureHtml(data) {
  return 'Dimensions:' + data.lenght + 'x' + data.height + 'x' + data.width
}
