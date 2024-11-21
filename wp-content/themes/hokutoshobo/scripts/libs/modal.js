"use strict";

class Modal {
  constructor() {
    this.toModals = document.querySelectorAll(".to-modal");
    this.modals = document.querySelectorAll(".modal__inner");
    this.toggle = document.querySelector(".modal__toggle-btn");
    this._init();
  }

  _init() {
    this.toModals.forEach(btn => {
      btn.addEventListener("click", (e) => {
        const dataName = e.target.dataset.name;
        this.modals.forEach(modal => {
          if (modal.classList.contains(dataName) ||
              modal.getAttribute("data-to-modal-matched-name") === dataName) {
            modal.classList.add("active");
            this.toggle.classList.add("active");
            this.toggle.dataset.name = dataName;
          }
        })
      });
      this.toggle.addEventListener("click", (e) => {
        const dataName = e.target.dataset.name;
        this.modals.forEach(modal => {
          if (modal.classList.contains(dataName) ||
              modal.getAttribute("data-to-modal-matched-name") === dataName) {
            modal.classList.remove("active");
            this.toggle.classList.remove("active");
          } 
        })
      })
    })
  }
}