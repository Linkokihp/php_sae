import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';

@Component({
  selector: 'app-counter',
  templateUrl: './counter.component.html',
  styleUrls: ['./counter.component.css']
})
export class CounterComponent implements OnInit {
  @Input() count = 0;
  @Output() limitReached = new EventEmitter<number>();
  limit = 10;

  constructor() { }

  ngOnInit(): void {
  }

  increaseCount() {
    if (this.count === this.limit) {
      return;
    }

    this.count++;

    if (this.count === this.limit) {
      this.limitReached.emit(this.limit);
    }
  }

}
