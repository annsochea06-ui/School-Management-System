@extends('layouts.app')

@section('content')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div x-data="{
        showCreateModal: false,
        showPayModal: false,
        activePayroll: null,
    
        openPayModal(payroll) {
            this.activePayroll = payroll;
            this.showPayModal = true;
        }
    }" class="w-full bg-[#0b0f19] text-slate-200 p-6 rounded-2xl border border-slate-800">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-white tracking-wide">Manage Payrolls</h1>
                <p class="text-xs text-slate-400 mt-1">List of monthly salaries and bonuses for teachers</p>
            </div>
            <!-- ចុចត្រង់នេះដើម្បីបើក Create Modal -->
            <button @click="showCreateModal = true"
                class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold py-2.5 px-4 rounded-xl transition shadow-lg shadow-indigo-600/30 flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-plus"></i>
                <span>+ create new payroll</span>
            </button>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto rounded-xl border border-slate-800/80 bg-[#0d1322]">
            <table class="w-full text-left text-xs">
                <thead
                    class="border-b border-slate-800 text-slate-400 font-semibold uppercase tracking-wider bg-slate-900/50">
                    <tr>
                        <th class="p-4">TEACHER NAME</th>
                        <th class="p-4">BASIC SALARY</th>
                        <th class="p-4">BONUS</th>
                        <th class="p-4">DEDUCTION</th>
                        <th class="p-4">NET SALARY</th>
                        <th class="p-4">MONTH/YEAR</th>
                        <th class="p-4">STATUS</th>
                        <th class="p-4 text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 font-medium">
                    @forelse ($payrolls as $payroll)
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="p-4 text-white font-bold">
                                {{ $payroll->teacher->first_name ?? '' }} {{ $payroll->teacher->last_name ?? '' }}
                            </td>
                            <td class="p-4 text-slate-200 font-semibold">${{ number_format($payroll->basic_salary, 2) }}
                            </td>
                            <td class="p-4 text-emerald-400 font-semibold">+${{ number_format($payroll->bonus, 2) }}</td>
                            <td class="p-4 text-rose-500 font-semibold">-${{ number_format($payroll->deduction, 2) }}</td>
                            <td class="p-4 text-indigo-400 font-bold">${{ number_format($payroll->net_salary, 2) }}</td>
                            <td class="p-4 text-slate-400">{{ $payroll->month_year }}</td>

                            <!-- Dynamic Status -->
                            <td class="p-4">
                                @if (strtoupper($payroll->status) === 'PAID')
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-extrabold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase tracking-wider">
                                        PAID
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-extrabold bg-rose-500/10 text-rose-500 border border-rose-500/20 uppercase tracking-wider">
                                        UNPAID
                                    </span>
                                @endif
                            </td>

                            <!-- Action Button -->
                            <td class="p-4 text-center">
                                @if (strtoupper($payroll->status) !== 'PAID')
                                    <button
                                        @click="openPayModal({
                                        id: {{ $payroll->id }},
                                        name: '{{ $payroll->teacher->first_name ?? '' }} {{ $payroll->teacher->last_name ?? '' }}',
                                        amount: '${{ number_format($payroll->net_salary, 2) }}',
                                        bank_account: '{{ $payroll->teacher->bank_account ?? 'N/A' }}',
                                        bank_name: '{{ $payroll->teacher->bank_name ?? 'ABA Bank' }}'
                                    })"
                                        class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg text-[11px] font-bold transition shadow-md shadow-indigo-600/20 cursor-pointer flex items-center gap-1.5 mx-auto">
                                        <i class="fa-solid fa-credit-card"></i>
                                        <span>Pay Now</span>
                                    </button>
                                @else
                                    <span
                                        class="text-emerald-400 text-[11px] font-bold flex items-center justify-center gap-1">
                                        <i class="fa-solid fa-circle-check"></i> Paid
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-6 text-center text-slate-500">គ្មានទិន្នន័យប្រាក់បៀវត្សរ៍ទេ</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal ១៖ Create New Payroll Modal -->
        <div x-show="showCreateModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
            style="display: none;">

            <div
                class="bg-[#111827] border border-slate-800 rounded-2xl w-full max-w-md p-6 shadow-2xl relative text-slate-200">
                <button @click="showCreateModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-white transition cursor-pointer">✕</button>

                <div class="border-b border-slate-800 pb-3 mb-4">
                    <h3 class="text-lg font-bold text-white">Create New Payroll</h3>
                    <p class="text-xs text-slate-400">បញ្ចូលព័ត៌មានប្រាក់ខែគ្រូសម្រាប់ខែថ្មី</p>
                </div>

                <!-- Form Tag inside Modal -->
                <form action="{{ route('payrolls.store') }}" method="POST" class="space-y-4 text-xs" @click.stop>
                    @csrf

                    <!-- Select Teacher -->
                    <div>
                        <label class="block text-slate-300 font-bold mb-1">Select Teacher *</label>
                        <select name="teacher_id" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:outline-none focus:border-indigo-500">
                            <option value="">-- Choose Teacher --</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Basic Salary (អាចវាយលេខបាន ១០០%) -->
                    <div>
                        <label class="block text-slate-300 font-bold mb-1">Basic Salary ($) *</label>
                        <input type="text" name="basic_salary" required placeholder="1000.00"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:outline-none focus:border-indigo-500">
                    </div>

                    <!-- Bonus & Deduction -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-slate-300 font-bold mb-1">Bonus ($)</label>
                            <input type="text" name="bonus" value="0"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-slate-300 font-bold mb-1">Deduction ($)</label>
                            <input type="text" name="deduction" value="0"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:outline-none focus:border-indigo-500">
                        </div>
                    </div>

                    <!-- Month/Year -->
                    <div>
                        <label class="block text-slate-300 font-bold mb-1">Month / Year *</label>
                        <input type="text" name="month_year" required placeholder="09-2026" value="{{ date('m-Y') }}"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t border-slate-800 mt-5">
                        <button type="button" @click="showCreateModal = false"
                            class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl transition font-bold cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl transition font-bold shadow-lg shadow-indigo-600/30 flex items-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-save"></i>
                            <span>Save Payroll</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal ២៖ Salary Payment Form Modal -->
        <div x-show="showPayModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
            style="display: none;">

            <div
                class="bg-[#111827] border border-slate-800 rounded-2xl w-full max-w-md p-6 shadow-2xl relative text-slate-200">
                <button @click="showPayModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-white transition cursor-pointer">✕</button>

                <div class="border-b border-slate-800 pb-3 mb-4">
                    <h3 class="text-lg font-bold text-white">Salary Payment Form</h3>
                    <p class="text-xs text-slate-400">ពិនិត្យព័ត៌មាន និងធ្វើការទូទាត់ប្រាក់ខែជូនគ្រូបង្រៀន</p>
                </div>

                <form :action="'/payrolls/' + activePayroll?.id + '/pay'" method="POST" class="space-y-4 text-xs">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-slate-400 mb-1">Teacher Name</label>
                        <input type="text" :value="activePayroll?.name" readonly
                            class="w-full bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2 text-white font-bold cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-slate-400 mb-1">Teacher Bank Account</label>
                        <div class="flex gap-2">
                            <input type="text" :value="activePayroll?.bank_name" readonly
                                class="w-1/3 bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2 text-indigo-400 font-bold cursor-not-allowed">
                            <input type="text" :value="activePayroll?.bank_account" readonly
                                class="w-2/3 bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2 text-amber-400 font-mono font-bold cursor-not-allowed">
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-400 mb-1">Net Salary Amount ($)</label>
                        <input type="text" :value="activePayroll?.amount" readonly
                            class="w-full bg-slate-900/60 border border-slate-800 rounded-xl px-3 py-2.5 text-emerald-400 font-extrabold text-base cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-slate-300 font-bold mb-1">Payment Method *</label>
                        <select name="payment_method" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:outline-none focus:border-indigo-500">
                            <option value="Bank Transfer">Bank Transfer (ABA / KHQR)</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-slate-300 font-bold mb-1">Note / Reference (Optional)</label>
                        <input type="text" name="note" placeholder="e.g., Transaction ID / Transfer Slip No"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t border-slate-800 mt-5">
                        <button type="button" @click="showPayModal = false"
                            class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl transition font-bold cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl transition font-bold shadow-lg shadow-emerald-600/30 flex items-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-check"></i>
                            <span>Confirm Payment</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    @if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: 'Payment Successful!',
            text: "{{ session('success') }}",
            icon: 'success',
            background: '#0d1322',
            color: '#fff',
            iconColor: '#10b981',
            confirmButtonColor: '#4f46e5',
            confirmButtonText: 'Great!',
            customClass: {
                popup: 'border border-slate-800 rounded-2xl shadow-2xl'
            }
        });
    });
</script>
@endif
@endsection
