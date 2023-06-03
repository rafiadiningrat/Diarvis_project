import styled from "styled-components";

 export const Styles = styled.div`
   .striped-table tbody tr:nth-child(even) {
     background-color: #000;
   }
   .table {
     .tr {
       :last-child {
         .td {
           border-bottom: 0;
         }
       }
     }

     .th {
       overflow: hidden;
     }
     .td {
       overflow: hidden;

       :last-child {
       }
     }

     &.sticky {
       overflow: scroll;

       .header,
       .footer {
         position: sticky;
         z-index: 1;
         width: fit-content;
       }

       .header {
         top: 0;
       }

       .footer {
         bottom: 0;
       }

       .body {
         position: relative;
         z-index: 0;
       }

       [data-sticky-td] {
         position: sticky;
       }
     }
   }
 `;