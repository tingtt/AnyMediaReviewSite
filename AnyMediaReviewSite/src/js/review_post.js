//seletにoptionの追加
function add_Product_Name() {
  //selectタグを取得する
  var productName_select = document.getElementById("product_name");
  //optionタグを作成する
  var option = document.createElement("option");
  //optionタグのテキストに入力した値を設定
  option.innerHTML = "テンガ";
  //optionタグのvalueを設定
  option.value = 1;
  //selectタグの子要素にoptionタグを追加
  productName_select.appendChild(option);
}

var add_textbox = document.getElementById("add_btn");
add_textbox.addEventListener('click', () => {
  var add_text = document.createElement("input");
  add_text.type = "text";
  var parent = document.getElementById("parent");
  parent.appendChild(add_text);
});
