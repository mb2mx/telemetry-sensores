import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { InlineSVGModule } from 'ng-inline-svg-2';
import { NgbTooltipModule } from '@ng-bootstrap/ng-bootstrap'; 
import { TicketComponent } from './ticket.component';
import { TicketRoutingModule } from './ticket.routing.module';
import { AssignedComponent } from './assigned/assigned.component';
import { DataTablesModule } from "angular-datatables";
import { ServicePagesModule } from 'src/app/services/modules/ticket.module';

@NgModule({
  declarations: [ 
    TicketComponent,
    AssignedComponent
  ],
  imports: [
    DataTablesModule,
    CommonModule,
    TicketRoutingModule,
    ReactiveFormsModule,
    InlineSVGModule,
    NgbTooltipModule,
    ServicePagesModule
    
  ],
})
export class TicketModule {}
