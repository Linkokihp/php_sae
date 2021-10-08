import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  message = 'Hello';
  count = 0;

  reset() {
    this.count = 0;
  }

  limitReached() {
    console.log('Limit reached!');
  }

  constructor() {
    setInterval(() => this.count++, 1000);
  }
}
