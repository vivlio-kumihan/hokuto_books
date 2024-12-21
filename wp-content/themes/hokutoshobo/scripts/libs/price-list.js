"use strict";

class PriceList {
  constructor() {
    this.tabs = document.querySelectorAll('.price-list__tab-menu > li');
    this.panels = document.querySelectorAll('.price-list__panel');
    this._init();
  }
  
  _init() {
    this.tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        // 全てのタブとパネルのアクティブ状態をリセット
        this.tabs.forEach(tab => tab.classList.remove('active'));
        this.panels.forEach(pane => pane.classList.remove('active'));
    
        // クリックしたタブと対応するパネルをアクティブに
        const targetName = tab.dataset.name;
        tab.classList.add('active');
        this.panels.forEach(pane => {
          if (pane.dataset.name === targetName) {
            pane.classList.add('active');
          }
        });
      });
    });
  }
}