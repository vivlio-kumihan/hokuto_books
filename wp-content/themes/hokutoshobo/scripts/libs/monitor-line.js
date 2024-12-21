class MonitorLine {
  constructor () {
    this.headers = Array.from(document.querySelectorAll('.main__header3'));
    this._init();
  }

  _init() {
    this.headers.map((head) => {
      // たまたまだかどうかわからないが、四捨五入して1行の高さの判定を同じだったらとしている。
      // だから、font-sizeを変更すると不具合が出る可能性あり。
      const lineHeight = Math.round(parseFloat(window.getComputedStyle(head).lineHeight));
      const elementHeight = head.offsetHeight;
      if (lineHeight < elementHeight) {
        return head.classList.add("two-lines-height");
      }
    })
  }
}