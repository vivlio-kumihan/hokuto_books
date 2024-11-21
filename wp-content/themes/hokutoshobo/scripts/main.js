class Main {
  constructor() {
    this.LatestYear = new LatestYear();
    this.HideHeader = new HideHeader();
    this.MonitorLine = new MonitorLine();
    this.fadeSlider = new FadeSlider('.swiper');
    this.fadeSlider.autoStart();
    new Modal();
    this._init();
  }
  _init() {
    new MobileMenu();
  }
}

new Main;


// class Main {
//   constructor() {
//     this.LatestYear = new LatestYear();
//     this.HideHeader = new HideHeader();
//     this.MonitorLine = new MonitorLine();
//     // // headerのインスタンを生成する。
//     // this.header = document.querySelector(".header");
//     // // テキスト・アニメーション用の小見出しを収集してアニメーション用にインスタンス化する。
//     // const targets = document.querySelectorAll('.animate-title');
//     // this.tas = [...targets].map(node => new GsapTextAnimation(node));
//     // // メモリー管理の観点から画面から隠れたスライダーは動作を停止させるための下準備。
//     // this.heroSlider = new HeroSlider('#hero > .swiper');
//     this.fadeSlider = new FadeSlider('.swiper');
//     // this.manualSlider = new ManualSlider('#manual-slider > .swiper');

//     // // event schedule
//     // this.setSetsubunIns = new SetSetsubun();
//     // const annualEvent = new AnnualEvent(this.setSetsubunIns);
//     // annualEvent.allEvents();
//     // annualEvent.select4Events();
//     // this.ruleLines = document.querySelectorAll(".rule-line");

//     // // souvenirs
//     // this.pl = new ProductLoader();
//     // this.pl.takeCartSpreadProduct().then(() => {
//     //   const takeCartIns = new TakeCart();
//     //   const cartResultCalcIns = new CartResultCalc(takeCartIns);
//     //   const sendFeeIns = new SendFee(takeCartIns);
//     //   new Order(takeCartIns, cartResultCalcIns, sendFeeIns);
//     // });

//     // modal
//     new Modal();

//     // // this.contentsSlider = new contentsSlider('.swiper.contents');   
//     // // 監視するスクロール・オブザーバーのインスタンスを収取するための配列を初期化する。
//     // this._observers = [];
//     // // サイドの飾りをインスタンス化する。
//     // this.asides = document.querySelectorAll('.side');
//     // 仕掛けのインスタンス化
//     this._init();
//   }
//   // end__constructor()//////////////////////////////////////////////////////////

//   _init() {
//     // // ローディングを済ませる前に仕掛けたアニメーションが終了するのを防ぐ。
//     // // ローディング（ページの読み込み）が終わるまでアニメーションを発火させないようにする。
//     // // Pace.jsのonメソッドに、終了を知らせる『done』が入るとコールバック関数を呼びなさいという命令。
//     // Pace.on('done', this._scrollInit.bind(this));
//     // 初期化の際に呼ぶ関数
//     new MobileMenu();
//     this._scrollInit();
//   }

//   // destroyメソッドを活かすために配列として格納している。
//   // SPAを作ることになった際に必要になってくるスキル。
//   destroy() {
//     this._observers.forEach(so => so.destroy());
//     console.log(this);
//   };

//   // // 複数のスクロール監視のインスタンスを配列として格納する。
//   _scrollInit() {
//     this._observers?.push(
//       new ScrollObserver('.swiper', this._toggleSlideAnimeCB.bind(this), { once: false }),
//       // new ScrollObserver('.nav-trigger', this._headerBgWhiteCB.bind(this), { once: false }),
//       // new ScrollObserver('.travel__texts', this._travelTextsCB, { once: true }),
//       // new ScrollObserver('.cover-slide', this._slideImageCB, { once: true }),
//       // new ScrollObserver('.appear', this._appearAnimeCB, { once: true }),
//       // new ScrollObserver('.animate-title', this._textAnimeCB.bind(this), { once: false }),     
//       // new ScrollObserver('#main-content', this._asideAnimeCB.bind(this), { once: false, rootMargin: "-300px 0px" }),
//       // // 個々の`<li>`要素を監視するために、各要素にScrollObserverを設定
//       // ...Array.from(this.ruleLines).map(li => new ScrollObserver(li, this._lineAnimeCB.bind(this), { once: false, rootMargin: "-150px 0px" }))
//     );
//   }
  
//   _toggleSlideAnimeCB(el, isIntersecting) {
//     if (isIntersecting) {
//       this.heroSlider.autoStart();
//       this.fadeSlider.autoStart();
//     } else {
//       this.heroSlider.autoStop();
//       this.fadeSlider.autoStop();
//     }    
//   }
  
//   // _headerBgWhiteCB(el, isIntersecting) {
//   //   if (isIntersecting) {
//   //     this.header.classList.remove('triggered');
//   //   } else {
//   //     this.header.classList.add('triggered');
//   //   }
//   // };  

//   // // Travel Texts
//   // _travelTextsCB(el, isIntersecting) {
//   //   if (isIntersecting) {
//   //     el.classList.add('inview');
//   //   } else {
//   //     el.classList.remove('inview');
//   //   }
//   // };

//   // // Slide in Images
//   // _slideImageCB(el, isIntersecting) {
//   //   if (isIntersecting) {
//   //     el.classList.add('inview');
//   //   } else {
//   //     el.classList.remove('inview');
//   //   }
//   // };

//   // // Appear Anime
//   // _appearAnimeCB(el, isIntersecting) {
//   //   if (isIntersecting) {
//   //     el.classList.add('inview');
//   //   } else {
//   //     el.classList.remove('inview');
//   //   }
//   // };

//   // // Title Text Animation
//   // _textAnimeCB(el, isIntersecting) {
//   //   if (isIntersecting) {
//   //     this.tas.forEach(ta => { if (ta.DOM.el === el) ta.animate(); })     
//   //   } else {
//   //     el.classList.remove('inview');
//   //   }
//   // };

//   // // Aside Animation
//   // _asideAnimeCB(el, isIntersecting) {
//   //   if (isIntersecting) {
//   //     this.asides.forEach(side => side.classList.add('inview'))
//   //   } else {
//   //     this.asides.forEach(side => side.classList.remove('inview'))
//   //   }
//   // };

//   // // editting
//   // // // Annual Event line Animation
//   // _lineAnimeCB(el, isIntersecting) {
//   //   if (isIntersecting) {
//   //     el.classList.add('inview');
//   //   } else {
//   //     el.classList.remove('inview');
//   //   }
//   // }
// }

// new Main;