<div x-data="{
datePickerOpen: false,
datePickerValue: '{{ $date }}',
datePickerFormat: 'YYYY-MM-DD',
datePickerMonth: '',
datePickerYear: '',
datePickerDay: '',
datePickerDaysInMonth: [],
datePickerBlankDaysInMonth: [],
datePickerMonthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
datePickerDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
datePickerDayClicked(day) {
let selectedDate = new Date(this.datePickerYear, this.datePickerMonth, day);
this.datePickerDay = day;
this.datePickerValue = this.datePickerFormatDate(selectedDate);
this.datePickerIsSelectedDate(day);
this.datePickerOpen = false;
},
datePickerPreviousMonth(){
if (this.datePickerMonth == 0) {
this.datePickerYear--;
this.datePickerMonth = 12;
}
this.datePickerMonth--;
this.datePickerCalculateDays();
},
datePickerNextMonth(){
if (this.datePickerMonth == 11) {
this.datePickerMonth = 0;
this.datePickerYear++;
} else {
this.datePickerMonth++;
}
this.datePickerCalculateDays();
},
datePickerIsSelectedDate(day) {
const d = new Date(this.datePickerYear, this.datePickerMonth, day);
return this.datePickerValue === this.datePickerFormatDate(d) ? true : false;
},
datePickerIsToday(day) {
const today = new Date();
const d = new Date(this.datePickerYear, this.datePickerMonth, day);
return today.toDateString() === d.toDateString() ? true : false;
},
datePickerCalculateDays() {
let daysInMonth = new Date(this.datePickerYear, this.datePickerMonth + 1, 0).getDate();
// find where to start calendar day of week
let dayOfWeek = new Date(this.datePickerYear, this.datePickerMonth).getDay();
let blankdaysArray = [];
for (var i = 1; i <= dayOfWeek; i++) {
blankdaysArray.push(i);
}
let daysArray = [];
for (var i = 1; i <= daysInMonth; i++) {
daysArray.push(i);
}
this.datePickerBlankDaysInMonth = blankdaysArray;
this.datePickerDaysInMonth = daysArray;
},
datePickerFormatDate(date) {
let formattedDay = this.datePickerDays[date.getDay()];
let formattedDate = ('0' + date.getDate()).slice(-2); // appends 0 (zero) in single digit date
let formattedMonth = this.datePickerMonthNames[date.getMonth()];
let formattedMonthShortName = this.datePickerMonthNames[date.getMonth()].substring(0, 3);
let formattedMonthInNumber = ('0' + (parseInt(date.getMonth()) + 1)).slice(-2);
let formattedYear = date.getFullYear();

if (this.datePickerFormat === 'M d, Y') {
return `${formattedMonthShortName} ${formattedDate}, ${formattedYear}`;
}
if (this.datePickerFormat === 'MM-DD-YYYY') {
return `${formattedMonthInNumber}-${formattedDate}-${formattedYear}`;
}
if (this.datePickerFormat === 'DD-MM-YYYY') {
return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`;
}
if (this.datePickerFormat === 'YYYY-MM-DD') {
return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`;
}
if (this.datePickerFormat === 'D d M, Y') {
return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`;
}

return `${formattedMonth} ${formattedDate}, ${formattedYear}`;
},
datePickerSetToday() {
const today = new Date();
this.datePickerMonth = today.getMonth();
this.datePickerYear = today.getFullYear();
this.datePickerDay = today.getDate();
this.datePickerValue = this.datePickerFormatDate(today);
this.datePickerCalculateDays();
this.datePickerOpen = false;
},
datePickerClear() {
this.datePickerValue = '';
this.datePickerOpen = false;
},
}" x-init="
currentDate = new Date();
if (datePickerValue) {
currentDate = new Date(Date.parse(datePickerValue));
}
datePickerMonth = currentDate.getMonth();
datePickerYear = currentDate.getFullYear();
datePickerDay = currentDate.getDay();
{{--datePickerValue = datePickerFormatDate( currentDate );--}}
datePickerCalculateDays();" v-cloak>
	<div {{ $attributes }}">
	<div class="w-auto ">
		<label for="datepicker" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ $label }}</label>
		<div class="relative sm:min-w-[17rem] w-full">
			<input id=datepicker name={{$name}} x-ref="datePickerInput" type="text"
				   @click="datePickerOpen=!datePickerOpen"
				   x-model="datePickerValue" x-on:keydown.escape="datePickerOpen=false"
				   class="appearance-none block
mt-1 w-full
bg-white dark:bg-gray-900
text-black dark:text-gray-50
border-gray-300 dark:border-gray-700
focus:border-indigo-500 dark:focus:border-indigo-400
focus:ring-indigo-500 dark:focus:ring-indigo-400
rounded-md shadow-sm
disabled:rounded-none disabled:shadow-none
disabled:border-t-transparent disabled:border-x-transparent
disabled:border-dashed
disabled:opacity-100
disabled:select-none placeholder-black dark:placeholder-white " placeholder="{{$placeholder}}" readonly/>
			<div @click="datePickerOpen=!datePickerOpen; if(datePickerOpen){ $refs.datePickerInput.focus() }"
				 class="absolute top-0 right-0 px-3 py-2 cursor-pointer text-neutral-400 hover:text-neutral-500">
				<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
				</svg>
			</div>
			<div
					x-show="datePickerOpen"
					x-transition
					@click.away="datePickerOpen = false"
					class="absolute top-0 left-0 max-w-lg p-4 mt-12 antialiased bg-white dark:bg-gray-800 border rounded-lg dark:border-gray-600 shadow w-[17rem] border-neutral-200/70 ">
				<div class="flex justify-center space-x-5">
					@if($buttonEnabled=='true')
					<span @click="datePickerClear"
							  class="text-white dark:text-gray-900
bg-gray-800 dark:bg-gray-200
hover:bg-gray-900 dark:hover:bg-gray-100
focus:bg-gray-900 dark:focus:bg-gray-100
active:bg-gray-950 dark:active:bg-gray-50 px-4 py-2 inline-block border border-transparent rounded-full
font-medium text-sm tracking-widest
focus:outline-none focus:ring-2
focus:ring-indigo-500 dark:focus:ring-indigo-400
focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">
{{$buttonLabel}}
</span>
					@endif
					<span @click="datePickerSetToday"
						  class="text-gray-900 dark:text-gray-200
bg-slate-50 dark:bg-slate-600
hover:bg-slate-200 dark:hover:bg-slate-700
focus:bg-slate-200 dark:focus:bg-slate-700
active:bg-slate-200 dark:active:bg-slate-700 px-4 py-2 inline-block border border-transparent rounded-full
font-medium text-sm tracking-widest
focus:outline-none focus:ring-2
focus:ring-indigo-500 dark:focus:ring-indigo-400
focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">
Today
</span>
				</div>
				<hr class="mt-3">
				<div class="flex items-center justify-between mb-2">
					<div>
<span x-text="datePickerMonthNames[datePickerMonth]"
	  class="text-lg font-bold text-gray-800 dark:text-white"></span>
						<span x-text="datePickerYear"
							  class="ml-1 text-lg font-normal text-gray-600 dark:text-gray-400"></span>
					</div>
					<div>
						<button @click="datePickerPreviousMonth()" type="button"
								class="inline-flex p-1 transition duration-100 ease-in-out rounded-full cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-100 dark:hover:bg-gray-800">
							<svg class="inline-flex w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24"
								 stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									  d="M15 19l-7-7 7-7"/>
							</svg>
						</button>
						<button @click="datePickerNextMonth()" type="button"
								class="inline-flex p-1 transition duration-100 ease-in-out rounded-full cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-100  dark:hover:bg-gray-800">
							<svg class="inline-flex w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24"
								 stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									  d="M9 5l7 7-7 7"/>
							</svg>
						</button>
					</div>
				</div>
				<div class="grid grid-cols-7 mb-3">
					<template x-for="(day, index) in datePickerDays" :key="index">
						<div class="px-0.5">
							<div x-text="day"
								 class="text-xs font-medium text-center text-gray-900 dark:text-gray-400"></div>
						</div>
					</template>
				</div>
				<div class="grid grid-cols-7">
					<template x-for="blankDay in datePickerBlankDaysInMonth">
						<div class="p-1 text-sm text-center border border-transparent"></div>
					</template>
					<template x-for="(day, dayIndex) in datePickerDaysInMonth" :key="dayIndex">
						<div class="px-0.5 mb-1 aspect-square">
							<div
									x-text="day"
									@click="datePickerDayClicked(day)"
									:class="{
'text-gray-600 dark:text-gray-200 hover:bg-neutral-200 dark:hover:bg-gray-700': datePickerIsSelectedDate(day) == false,
'bg-neutral-800 dark:bg-gray-900 text-white hover:bg-opacity-75': datePickerIsSelectedDate(day) == true
}"
									class="flex items-center justify-center text-sm leading-none text-center rounded-full cursor-pointer h-7 w-7"></div>
						</div>
					</template>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
