@extends('layouts.app')

@section('content')
    <div x-data="{
        selectedInvoices: [],
        selectAll: false,
        showViewModal: false,
        showCreateModal: false,
        activeInvoice: null,
    
        toggleSelectAll() {
            this.selectAll = !this.selectAll;
            if (this.selectAll) {
                this.selectedInvoices = Array.from(document.querySelectorAll('.invoice-checkbox')).map(el => el.value);
            } else {
                this.selectedInvoices = [];
            }
        },
        openInvoice(invoice) {
            this.activeInvoice = invoice;
            this.showViewModal = true;
        }
    }" class="w-full bg-[#0b0f19] text-slate-200 p-6 rounded-2xl border border-slate-800">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-white tracking-wide">CYBERTECH ACADEMY</h1>
                <p class="text-xs text-slate-400 mt-1">Manage tuition fees and payment tracking</p>
            </div>

            <!-- ប៊ូតុង + create new invoice (ដំណើរការបើក Pop-up) -->
            <button @click="showCreateModal = true"
                class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold py-2.5 px-4 rounded-xl transition shadow-lg shadow-indigo-600/30 flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-plus"></i>
                <span>+ create new invoice</span>
            </button>
        </div>

        <!-- Dynamic Invoice Table -->
        <div class="overflow-x-auto rounded-xl border border-slate-800/80 bg-[#0d1322]">
            <table class="w-full text-left text-xs">
                <thead
                    class="border-b border-slate-800 text-slate-400 font-semibold uppercase tracking-wider bg-slate-900/50">
                    <tr>
                        <th class="p-4 w-10 text-center">
                            <input type="checkbox" @click="toggleSelectAll()" :checked="selectAll"
                                class="rounded border-slate-700 bg-slate-900 text-indigo-500 focus:ring-0 cursor-pointer w-4 h-4">
                        </th>
                        <th class="p-4">INVOICE NO</th>
                        <th class="p-4">STUDENT NAME</th>
                        <th class="p-4">TOTAL AMOUNT</th>
                        <th class="p-4">AMOUNT PAID</th>
                        <th class="p-4">DUE DATE</th>
                        <th class="p-4">STATUS</th>
                        <th class="p-4 text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 font-medium">

                    <!-- Dynamic Loop ពី Database -->
                    @forelse ($invoices as $invoice)
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="p-4 text-center">
                                <input type="checkbox" value="{{ $invoice->id }}" x-model="selectedInvoices"
                                    class="invoice-checkbox rounded border-slate-700 bg-slate-900 text-indigo-500 focus:ring-0 cursor-pointer w-4 h-4">
                            </td>
                            <td class="p-4 font-mono text-indigo-400 cursor-pointer hover:underline"
                                @click="openInvoice({
                                no: '{{ $invoice->invoice_no }}', 
                                name: '{{ $invoice->student->first_name }} {{ $invoice->student->last_name }}', 
                                total: '${{ number_format($invoice->total_amount, 2) }}', 
                                paid: '${{ number_format($invoice->amount_paid, 2) }}', 
                                date: '{{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}', 
                                status: '{{ $invoice->status }}'
                            })">
                                {{ $invoice->invoice_no }}
                            </td>
                            <td class="p-4 text-white font-bold">
                                {{ $invoice->student->first_name }} {{ $invoice->student->last_name }}
                            </td>
                            <td class="p-4 text-slate-200 font-semibold">${{ number_format($invoice->total_amount, 2) }}
                            </td>
                            <td class="p-4 text-emerald-400 font-semibold">${{ number_format($invoice->amount_paid, 2) }}
                            </td>
                            <td class="p-4 text-slate-400">
                                {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</td>
                            <td class="py-3 px-6">
                                @if (strtoupper($invoice->status) === 'PAID')
                                    <span
                                        class="px-3 py-1 text-[11px] font-bold text-emerald-400 bg-emerald-950/40 border border-emerald-500/30 rounded-full">
                                        PAID
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 text-[11px] font-bold text-rose-400 bg-rose-950/40 border border-rose-500/30 rounded-full">
                                        UNPAID
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <button type="button" onclick="openInvoiceModal({{ $invoice->id }})"
                                    class="px-3 py-1.5 rounded-lg bg-indigo-600/20 hover:bg-indigo-600 text-indigo-300 hover:text-white text-xs font-semibold transition border border-indigo-500/30">
                                    Payment
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-6 text-center text-slate-500">គ្មានទិន្នន័យវិក្កយបត្រទេ</td>
                        </tr>
                    @endforelse

                    @foreach ($invoices as $invoice)
                        <!-- INVOICE DETAILS MODAL -->
                        <div id="invoice-modal-{{ $invoice->id }}"
                            class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
                            <div
                                class="bg-[#0f172a] rounded-2xl shadow-2xl w-full max-w-md border border-slate-800 p-6 space-y-4 text-left">

                                <!-- Header -->
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-[10px] font-bold text-indigo-400 tracking-wider uppercase">CYBERTECH
                                            ACADEMY</p>
                                        <h3 class="text-xl font-extrabold text-white">INVOICE DETAILS</h3>
                                        <p class="text-xs font-mono text-slate-400 mt-0.5">{{ $invoice->invoice_no }}</p>
                                    </div>
                                    <button type="button" onclick="closeInvoiceModal({{ $invoice->id }})"
                                        class="text-slate-400 hover:text-white text-lg font-bold">&times;</button>
                                </div>

                                <!-- Details -->
                                <div class="space-y-3 pt-2 text-xs border-t border-slate-800/80">
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">Student Name:</span>
                                        <span class="font-bold text-white">{{ $invoice->student->first_name ?? '' }}
                                            {{ $invoice->student->last_name ?? '' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">Total Amount:</span>
                                        <span
                                            class="font-bold text-white">${{ number_format($invoice->total_amount, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">Amount Paid:</span>
                                        <span
                                            class="font-bold text-emerald-400">${{ number_format($invoice->amount_paid, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">Due Date:</span>
                                        <span
                                            class="text-slate-300">{{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-slate-400">Status:</span>
                                        <span
                                            class="font-bold {{ strtoupper($invoice->status) == 'PAID' ? 'text-emerald-400' : 'text-amber-500' }}">
                                            {{ strtoupper($invoice->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="pt-4 flex items-center justify-between gap-2">

                                    <!-- Form Pay Now -->
                                    <form action="{{ route('tuition-fees.pay-now', $invoice->id) }}" method="POST"
                                        class="flex-1">
                                        @csrf
                                        <button type="submit"
                                            class="w-full py-2.5 bg-indigo-900/60 hover:bg-indigo-700 text-indigo-200 hover:text-white text-xs font-semibold rounded-xl transition border border-indigo-500/30">
                                            Pay Now
                                        </button>
                                    </form>

                                    <button type="button" onclick="closeInvoiceModal({{ $invoice->id }})"
                                        class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold rounded-xl transition">
                                        Close
                                    </button>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- ២. Pop-up សម្រាប់បង្កើត CREATE NEW INVOICE MODAL -->
        <div x-show="showCreateModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
            style="display: none;">

            <div
                class="bg-[#111827] border border-slate-800 rounded-2xl w-full max-w-lg p-6 shadow-2xl relative text-slate-200">
                <button @click="showCreateModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-white transition">✕</button>

                <div class="border-b border-slate-800 pb-3 mb-5">
                    <h3 class="text-lg font-bold text-white">Create New Invoice</h3>
                    <p class="text-xs text-slate-400">បង្កើតវិក្កយបត្របង់ប្រាក់ថ្មីសម្រាប់សិស្ស</p>
                </div>

                <form action="{{ route('invoices.store') }}" method="POST" class="space-y-4 text-xs">
                    @csrf

                    <!-- Select Student (Dynamic) -->
                    <div>
                        <label class="block text-slate-300 font-bold mb-1.5">Select Student *</label>
                        <select name="student_id" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                            <option value="">-- Choose Student --</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}
                                    ({{ $student->student_code ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Total Amount & Amount Paid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-300 font-bold mb-1.5">Total Amount ($) *</label>
                            <input type="number" step="0.01" name="total_amount" required placeholder="0.00"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-slate-300 font-bold mb-1.5">Amount Paid ($) *</label>
                            <input type="number" step="0.01" name="amount_paid" required placeholder="0.00"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                        </div>
                    </div>

                    <!-- Due Date & Status -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-300 font-bold mb-1.5">Due Date *</label>
                            <input type="date" name="due_date" required
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-slate-300 font-bold mb-1.5">Payment Status *</label>
                            <select name="status" required
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                                <option value="PAID">PAID</option>
                                <option value="PARTIAL">PARTIAL</option>
                                <option value="UNPAID">UNPAID</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t border-slate-800 mt-6">
                        <button type="button" @click="showCreateModal = false"
                            class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl transition font-bold">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl transition font-bold shadow-lg shadow-indigo-600/30">
                            Save Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script>
        function openInvoiceModal(id) {
            let modal = document.getElementById('invoice-modal-' + id);
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeInvoiceModal(id) {
            let modal = document.getElementById('invoice-modal-' + id);
            if (modal) {
                modal.classList.add('hidden');
            }
        }
    </script>
    @if(session('success'))
    <!-- Import SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            background: '#0f172a',
            color: '#fff',
            confirmButtonColor: '#4f46e5',
            timer: 3000
        });
    </script>
@endif
@endsection
