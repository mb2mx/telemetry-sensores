import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AssignedComponent } from './assigned/assigned.component';
import { TicketComponent } from './ticket.component'; 

const routes: Routes = [
  {
    path: '',
    component: TicketComponent,
    children: [
      {
        path: 'assigned',
        component: AssignedComponent  ,
      },
      { path: '', redirectTo: 'assigned', pathMatch: 'full' },
      { path: '**', redirectTo: 'assigned', pathMatch: 'full' },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class TicketRoutingModule {}
