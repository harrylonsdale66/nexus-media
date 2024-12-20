import DataTable from 'datatables.net-dt';

let table = new DataTable('#data-table', {
    ajax: '/get-orders',
    lengthMenu: [5, 10, 25, 50],
    pageLength: 5,
    ordering: true,
    pagingType: 'full_numbers',
    dom: 'tlrip',
    columns: [
        { data: 'customer_name' },
        { data: 'customer_email' },
        { data: 'total_price' },
        { data: 'financial_status' },
        { data: 'fulfillment_status' }
    ],
});

document.getElementById('search').addEventListener('input', function () {
    table.column(3).search(this.value).draw();
});
