@extends('layouts.admin')

@section('title', 'Calendrier des réservations')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Calendrier des réservations
                    </h2>
                    <div class="flex space-x-2">
                        <button id="todayBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Aujourd'hui
                        </button>
                        <select id="statusFilter" class="border border-gray-300 rounded px-3 py-2">
                            <option value="all">Tous les statuts</option>
                            <option value="new">Nouveau</option>
                            <option value="confirmed">Confirmé</option>
                        </select>
                        <select id="vehicleFilter" class="border border-gray-300 rounded px-3 py-2">
                            <option value="all">Tous les véhicules</option>
                        </select>
                    </div>
                </div>

                <div id="calendar" class="w-full"></div>
            </div>
        </div>
    </div>
</div>

<!-- Booking Details Modal -->
<div id="bookingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Détails de la réservation</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent" class="text-sm text-gray-500">
                <!-- Content will be loaded here -->
            </div>
            <div class="flex justify-end mt-4 space-x-2">
                <button id="editBookingBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Modifier
                </button>
                <button id="closeModalBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById('bookingModal');
    const modalContent = document.getElementById('modalContent');
    const closeModal = document.getElementById('closeModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const editBookingBtn = document.getElementById('editBookingBtn');
    const todayBtn = document.getElementById('todayBtn');
    const statusFilter = document.getElementById('statusFilter');
    const vehicleFilter = document.getElementById('vehicleFilter');

    let currentBookingId = null;

    // Initialize FullCalendar
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: {
            today: 'Aujourd\'hui',
            month: 'Mois',
            week: 'Semaine',
            day: 'Jour'
        },
        events: @json($bookings),
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            currentBookingId = info.event.id;
            showBookingDetails(info.event.id);
        },
        eventDidMount: function(info) {
            // Add tooltip
            info.el.title = info.event.title;
        },
        height: 'auto',
        contentHeight: 600,
        aspectRatio: 1.35
    });

    calendar.render();

    // Load vehicles for filter
    fetch('/admin/api/vehicles')
        .then(response => response.json())
        .then(vehicles => {
            vehicles.forEach(vehicle => {
                const option = document.createElement('option');
                option.value = vehicle.id;
                option.textContent = vehicle.name;
                vehicleFilter.appendChild(option);
            });
        });

    // Event listeners
    todayBtn.addEventListener('click', function() {
        calendar.today();
    });

    statusFilter.addEventListener('change', filterEvents);
    vehicleFilter.addEventListener('change', filterEvents);

    closeModal.addEventListener('click', hideModal);
    closeModalBtn.addEventListener('click', hideModal);

    editBookingBtn.addEventListener('click', function() {
        if (currentBookingId) {
            window.location.href = `/admin/bookings/${currentBookingId}/edit`;
        }
    });

    function filterEvents() {
        const statusValue = statusFilter.value;
        const vehicleValue = vehicleFilter.value;

        calendar.getEvents().forEach(event => {
            let show = true;

            if (statusValue !== 'all') {
                const eventStatus = event.extendedProps.status;
                if (eventStatus !== statusValue) {
                    show = false;
                }
            }

            if (vehicleValue !== 'all') {
                const eventVehicleId = event.extendedProps.vehicle_id;
                if (eventVehicleId != vehicleValue) {
                    show = false;
                }
            }

            event.setProp('display', show ? 'auto' : 'none');
        });
    }

    function showBookingDetails(bookingId) {
        fetch(`/admin/api/bookings/${bookingId}`)
            .then(response => response.json())
            .then(booking => {
                modalContent.innerHTML = `
                    <div class="grid grid-cols-2 gap-4">
                        <div><strong>Client:</strong> ${booking.customer_name}</div>
                        <div><strong>Téléphone:</strong> ${booking.customer_phone}</div>
                        <div><strong>Email:</strong> ${booking.customer_email}</div>
                        <div><strong>Véhicule:</strong> ${booking.vehicle.name}</div>
                        <div><strong>Date de prise en charge:</strong> ${new Date(booking.pickup_time).toLocaleString('fr-FR')}</div>
                        <div><strong>Lieu de prise en charge:</strong> ${booking.pickup_location}</div>
                        <div><strong>Destination:</strong> ${booking.destination}</div>
                        <div><strong>Statut:</strong>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full ${
                                booking.status === 'confirmed' ? 'bg-green-100 text-green-800' :
                                booking.status === 'new' ? 'bg-yellow-100 text-yellow-800' :
                                'bg-gray-100 text-gray-800'
                            }">
                                ${booking.status === 'confirmed' ? 'Confirmé' :
                                  booking.status === 'new' ? 'Nouveau' : booking.status}
                            </span>
                        </div>
                        <div><strong>Prix:</strong> ${booking.price ? booking.price + ' €' : 'Non défini'}</div>
                        <div><strong>Notes:</strong> ${booking.notes || 'Aucune'}</div>
                    </div>
                `;
                modal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error loading booking details:', error);
                modalContent.innerHTML = '<p class="text-red-500">Erreur lors du chargement des détails de la réservation.</p>';
                modal.classList.remove('hidden');
            });
    }

    function hideModal() {
        modal.classList.add('hidden');
        currentBookingId = null;
    }

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            hideModal();
        }
    });
});
</script>
@endsection
