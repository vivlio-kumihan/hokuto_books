"use strict";

// LSは、localStorageの略

// 注文を管理するクラス
class Order {
  constructor(takeCartIns, cartResultCalcIns, sendFeeIns) {
    this.takeCartIns = takeCartIns;
    this.cartResultCalcIns = cartResultCalcIns;
    this.sendFeeIns = sendFeeIns;
    this.prefSettedEl = document.querySelector("#pref-setted-el");
    this.orderContainerEL = document.querySelector(".order-container");
    this.orderFormEL = document.querySelector(".order-form");
    this.orderThanksEL = document.querySelector(".order-thanks");
    this.confirmOrderBtn = document.querySelector(".order-confirm");
    this.orderedResultSubTotalEl = document.querySelector(".ordered-result__sub-total");
    this.orderedResultTotalEl = document.querySelector(".ordered-result__total");
    this.backToCartBtn = document.querySelector(".order-back-to-cart");
    this.backToHomeBtn = document.querySelector(".order-back-to-home");
    this.startAppProcess = document.querySelector(".start-app-process");
    this.orderedItems = this.takeCartIns.cartResultCalcIns.orderedEachItemResultMth || [];    
    this.formData = this._getFormDataFromLS();
    this.inputEls = document.querySelectorAll(".order-form__input");
    this.selectedPrefName = null;  // 都道府県名を保持するプロパティ
    this._init();
  }

  _init() {
    // 初期設定
    this.renderPref();

    // 選択した都道府県の名称を取得する。
    this._getSelectPrefName();

    if (this.prefSettedEl === null) return;
    this.prefSettedEl.addEventListener("change", () => {
      console.log(this._updateTotalFee());
      this._updateTotalFee();
      // this._getFee()
      this._reRenderTotalFee();
      // emailJS用　金額
      const subTotalFee = document.querySelector(".ordered-content.subTotalFee")
      const totalSendFee = document.querySelector(".ordered-content.totalSendFee")
      const grandTotalFee = document.querySelector(".ordered-content.grandTotalFee")
      subTotalFee.value = this._getFee().itemAmount;
      totalSendFee.value = this._getFee().sendFee;
      grandTotalFee.value = this._getFee().itemAmount + this._getFee().sendFee;
    });
    
    // 『申し込む』ボタンをクリックしてイベントを発火。
    this.confirmOrderBtn.addEventListener("click", () => {
      // Sub Total
      // 既存のリストをクリア
      this.orderedResultSubTotalEl.innerHTML = '';      
      // 生成されたHTML文字列をDOM要素に変換
      const tempDiv1 = document.createElement("div");
      tempDiv1.innerHTML = this._getOrderedlistElFn();
      Array.from(tempDiv1.children).forEach(el => this.orderedResultSubTotalEl.prepend(el))
      
      // Total
      // 既存のリストをクリア
      this.orderedResultTotalEl.innerHTML = '';      
      // 生成されたHTML文字列をDOM要素に変換
      const tempDiv2 = document.createElement("div");
      tempDiv2.innerHTML = this._getTotalFeeElFn();
      Array.from(tempDiv2.children).forEach(el => this.orderedResultTotalEl.prepend(el))
      this.orderContainerEL.classList.add("active");

      // emailJS用　選択した商品のスペック
      const selectItems = document.querySelector(".ordered-content.selectItems");
      selectItems.value = this._getOrderedlist4emaiJS();
    });
    
    // 戻るボタンのイベントリスナー。
    this.backToCartBtn.addEventListener("click", () => {
      this.orderedResultSubTotalEl.innerHTML = '';
      this.orderContainerEL.classList.remove("active");
    });

    // 取引開始ボタンのイベントリスナー。
    this.startAppProcess.addEventListener("click", () => {
      if (this.orderFormEL.checkValidity()) {
        // バリデーションが成功した場合のみ、フォームを送信し、ページ遷移する
        this.orderFormEL.requestSubmit();
        this.orderContainerEL.classList.remove("active");
        this.orderThanksEL.classList.add("active");
      } else {
        // バリデーションエラーがある場合、エラーを表示する
        this.orderFormEL.reportValidity();
      }
    });

    // this.startAppProcess.addEventListener("click", () => {
    //   this.orderFormEL.requestSubmit();

    //   this.orderContainerEL.classList.remove("active");
    //   this.orderThanksEL.classList.add("active");
    // });

    // 取引開始ウィンドウからホームへ戻る。その際にローカル・ストレージを初期化する。
    this.backToHomeBtn.addEventListener("click", () => {
      localStorage.clear();
      this.orderThanksEL.classList.remove("active");
      this.backToHomeBtn.addEventListener("click", function() {
        window.location.href = "https://daihoonji.jp/";
      })
    });

    this._initializeForm();
    this._handleFormInput();
  }

  renderPref() {
    const prefs = this.sendFeeIns.PREFECTURE;
    
    if (!prefs) return;
    if (this.prefSettedEl === null) return;
    
    this.prefSettedEl.innerHTML = "";
    prefs.forEach(pref => {
      const optionEl = document.createElement("option");
      optionEl.textContent = pref;
      optionEl.setAttribute("data-pref-name", pref);
      this.prefSettedEl.appendChild(optionEl);
    })
  };
  
  _getSelectPrefName() {
    if (this.prefSettedEl === null) return;
    const selectedIndex = this.prefSettedEl.selectedIndex;
    // selectedIndexが-1の場合には、nullを返す。
    if (selectedIndex === -1) {
      return null;
    }

    const selectedOptionEl = this.prefSettedEl.options[selectedIndex];
    
    // selectedOptionElが存在する場合のみ属性を取得。
    if (selectedOptionEl) {
      const selectedPrefName = selectedOptionEl.getAttribute("data-pref-name");
      return selectedPrefName;
    }
  }

  _updateTotalFee() {
    const prefName = this._getSelectPrefName();
    const fee = this.sendFeeIns.feeCalcMth(prefName);
    return fee;
  }

  _totalCalc() {
    const orderedItems = this.takeCartIns.cartResultCalcIns.orderedEachItemResultMth;
    const totalWeight = orderedItems.reduce((acc, item) => { return acc + item["重量小計"] }, 0);
    const totalAmount = orderedItems.reduce((acc, item) => { return acc + item["小計"] }, 0);
    const result = {totalWeight: totalWeight, totalAmount: totalAmount};
    return result;
  }

  _getOrderedlistElFn() {
    // orderedEachItemResultFn()から配列を取得する。
    const orderedItems = this.takeCartIns.cartResultCalcIns.orderedEachItemResultMth;
    // reduce()を使用してリストアイテムのHTMLを生成する。
    const liContent = orderedItems.reduce((acc, obj) => {
      // 個数はオブジェクトなので、文字列に変換するため分けて処理する。
      const orderQuantity = Object.keys(obj["内訳"]).reduce((acc, key) => {
        const list = key !== "SELF"
          ? `<span>${key}／${obj["内訳"][key]}個</span>`
          : `<span>${obj["内訳"][key]}個</span>`;
        return acc + list;
      }, "");
      // li要素の生成。
      const itemLiContent = `
        <li class="ordered-result__item">
          <div class="ordered-result__item-name"><span>品名&ensp;:&ensp;</span>${obj["品名"]}</div>
          <div class="ordered-result__item-quantity"><span>数量&ensp;:&ensp;</span>${orderQuantity}</div>
          <div class="ordered-result__item-sub-total"><span>小計&ensp;:&ensp;</span>${obj["小計"]}円</div>
        </li>
      `;
      // accumulatorに現在のアイテムを追加して統合していく。
      return acc + itemLiContent;
    }, "");
    return liContent;
  };

  _getFee() {
    const prefName = this._getSelectPrefName();
    const itemAmount = this._totalCalc().totalAmount;   
    const sendFee = this.sendFeeIns.feeCalcMth(prefName);
    const totalAmount = itemAmount + sendFee;
    return { itemAmount: itemAmount, sendFee: sendFee, totalAmount: totalAmount };
  }

  _getTotalFeeElFn() {
    const liContent = `
      <li class="ordered-result__total-list">
        <div class="ordered-result__total-item-amount">授与品合計 : ${ this._getFee().itemAmount }円</div>
        <div class="ordered-result__total-fee">送料 : ${ this._getFee().sendFee }円</div>
        <div class="ordered-result__total-total-amount">合計 : ${ this._getFee().itemAmount + this._getFee().sendFee }<span>円</span></div>
      </li>
    `;    
    // 検証用　なお、今回は、特に総重量の表示は必要ないので省く。
    // <div class="ordered-result__total-weight">総重量 : ${weight}g</div>
    return liContent;
  }

  _getOrderedlist4emaiJS() {
    // orderedEachItemResultFn()から配列を取得する。
    const orderedItems = this.takeCartIns.cartResultCalcIns.orderedEachItemResultMth;
    // reduce()を使用してリストアイテムのHTMLを生成する。
    const selectItems = orderedItems.reduce((acc, obj) => {
      // 個数はオブジェクトなので、文字列に変換するため分けて処理する。
      const orderQuantity = Object.keys(obj["内訳"]).reduce((acc, key) => {
        const list = key !== "SELF"
          ? `${key}／${obj["内訳"][key]}個`
          : `${obj["内訳"][key]}個`;
        return acc + list;
      }, "");
      // li要素の生成。
      const item = `
        品名 : ${obj["品名"]}
        数量 : ${orderQuantity}
        小計 : ${obj["小計"]}円
      `;
      // accumulatorに現在のアイテムを追加して統合していく。
      return acc + item;
    }, "");
    return selectItems;
  };

  _reRenderTotalFee() {
    this.orderedResultTotalEl.innerHTML = '';      
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = this._getTotalFeeElFn();
    Array.from(tempDiv.children).forEach(el => this.orderedResultTotalEl.prepend(el));
  }

  // フォーム用
  _initializeForm() {
    this.inputEls.forEach(el => {
      el.value = this.formData[el.name] ? this.formData[el.name] : "";
    });
  }
  _handleFormInput() {
    this.inputEls.forEach(el => {
      el.addEventListener("input", () => {
        this.formData[el.name] = el.value;
        this._saveFormDataToLS();
      });
    });
  }

  _getFormDataFromLS() {
    let formData = {};
    try {
      const data = localStorage.getItem("localStorageForm");
      formData = data ? JSON.parse(data) : {};
    } catch (e) {
      console.error("Error parsing localStorage data", e);
    }
    return formData;
  }

  _saveFormDataToLS() {
    localStorage.setItem("localStorageForm", JSON.stringify(this.formData));
  }  

  _deleteLocalStrageDate() {
  }
}









// prefInOptionFn() {
//   const weight = this._totalCalc().totalWeight;   
//   const itemAmount = this._totalCalc().totalAmount;   
//   const fee = this.sendFeeIns.feeCalcMth();
//   const totalAmount = itemAmount + fee;
//   const liContent = `
//     <li>
//     <div class="weight">総重量 : ${weight}g</div>
//     <div class="itemAmount">授与品合計 : ${itemAmount}円</div>
//       <div class="fee">送料 : ${fee}円</div>
//       <div class="fee">合計 : ${totalAmount}円</div>
//     </li>
//   `;    
//   return liContent;
// }