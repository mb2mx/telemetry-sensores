import { Injectable,AfterViewInit, Component, OnDestroy, OnInit, ViewChild } from '@angular/core';
import { DataTableDirective } from 'angular-datatables';
import { HttpClient } from '@angular/common/http';
import { Subject } from 'rxjs/internal/Subject';
import { Observable } from 'rxjs';
import { TicketService } from 'src/app/services/modules/ticket/ticket.service';
 
declare var $: any;
declare var mUtil: any;

 
@Component({
  selector: 'app-assigned',
  templateUrl: './assigned.component.html',
  styleUrls: ['./assigned.component.scss']
})
export class AssignedComponent implements   AfterViewInit, OnDestroy,OnInit {
  @ViewChild(DataTableDirective, {static: false})
  dtElement: DataTableDirective;

  allUsers = new Subject<any>();
  allUsers$ = this.allUsers.asObservable();

   dtOptions: DataTables.Settings = {};
   dtTrigger: Subject<any> = new Subject();
   myArray :any;

  protected datatable: any;
  protected filterSearch: any;

  constructor( private http : HttpClient, private ticketService: TicketService) { }

  ngOnInit(): void {

    this.dtOptions = {
      responsive: true,
      processing: true,
      serverSide: true,
      order: [[5, 'desc']],
        
    };
    this.loadTickets();
  }
// Get employees list
async loadTickets() {
  return await this.ticketService.findAll().subscribe((data: {}) => {
    this.myArray = data;
    this.allUsers.next(data);
    console.log(this.allUsers );
    //this.dtTrigger.next(this.allUsers );
  });
}
 
  ngAfterViewInit(): void {
    this.dtTrigger.next(this.allUsers );
  }

  ngOnDestroy(): void {
    // Do not forget to unsubscribe the event
    this.dtTrigger.unsubscribe();
  }

}
