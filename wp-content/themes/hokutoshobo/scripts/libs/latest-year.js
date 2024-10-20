class LatestYear {
  constructor () {
    this.latestYear = document.querySelector(".latest-year");
    this.year = new Date().getFullYear();
    this._init();
  }
  _init() {
    this.latestYear.textContent = this.year;
  }
}