/* 
/*** 売り場と商品のデータを外部化するためのクラス。
*/

"use strict";

// LSは、localStorageの略

class ProductLoader {
  async loadTemplate() {
    // これがHTMLファイルの取り方
    // （目的はtemplate要素の一群を取り込むため）
    const response = await fetch('../scripts/libs/files/take-cart__product-template.html');
    // const response = await fetch('./scripts/libs/files/take-cart__product-template.html');
    const text = await response.text();
    const parser = new DOMParser();
    const doc = parser.parseFromString(text, 'text/html');
    // docには、template.htmlのheader,bodyまで全部入りのHTMLが入る。
    // このDOMの統括する要素をとり、それに対してcontentメソッドを送ると
    // #document fragmentという目印が付いて『文書の断片』が取れる。
    return doc.getElementById('product-template').content;
  }

  async loadProducts() {
    // これがJSONの取り方
    const response = await fetch('../scripts/libs/files/take-cart__products-data.json');
    // const response = await fetch('./scripts/libs/files/take-cart__products-data.json');
    // ステータスがfulfilledでファイルに設定している値を格納している
    // Promiseインスタンスを返す。
    return response.json();
  }

  async takeCartSpreadProduct() {
    try {
      const template = await this.loadTemplate();
      const products = await this.loadProducts();
      const productList = document.getElementById('products');
      if (productList === null) return;
      products.forEach(product => {
        const clone = document.importNode(template, true);
        clone.querySelector('.product__image').setAttribute("src", product.url);
        clone.querySelector('.product__name').textContent = product.name;
        clone.querySelector('.product__types').innerHTML = product.type.map(val => `<li class="product__type-item">${val}</li>`).join("");
        clone.querySelector('.product__price').textContent = product.price;
        clone.querySelector('.product__weight').textContent = product.weight;
        clone.querySelector('.more-view').setAttribute("data-more-view-name", product.name);
        clone.querySelector('.toggle-btn').setAttribute("data-product-name", product.name);
        productList.appendChild(clone);
      });
    } catch (error) {
      console.error('Error:', error);
    } finally {
      console.log("商品を陳列する処理は終了です。");
    }
  }
}