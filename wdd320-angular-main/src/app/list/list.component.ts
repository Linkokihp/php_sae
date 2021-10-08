import { Component, Input } from '@angular/core';
import { ListItem } from '../model';

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.css']
})
export class ListComponent {
  @Input() items: ListItem[] = [];

  addItem(itemNameInput: HTMLInputElement) {
    this.items.push({
      id: '' + this.items.length + 1,
      done: false,
      title: itemNameInput.value
    });
    itemNameInput.value = '';
    itemNameInput.focus();
  }

  updateItemDone(item: ListItem, done: boolean) {
    item.done = done;
  }

  deleteItem(item: ListItem) {
    const index = this.items.indexOf(item);
    this.items.splice(index, 1);
  }

  get totalItems() {
    return this.items.length;
  }

  get completedItems() {
    return this.items.filter(item => item.done).length;
  }
}
