import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'DevChuva';

  readMore() {
    const dots = document.getElementById('dots');
    const more = document.getElementById('more');
    const readMoreBtn = document.querySelector('.btn-show-more');

    if (dots && more && readMoreBtn)
      if (dots.style.display === "none") {
        dots.style.display = "inline";
        more.style.display = "none"
        readMoreBtn.innerHTML = "ver mais"
      } else {
        dots.style.display = "none";
        more.style.display = "inline"
        readMoreBtn.innerHTML = "ver menos"
      }
  }
}