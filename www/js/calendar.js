var Cal = function(divId) {

  //Store div id
  this.divId = divId;

  // Days of week, starting on Sunday
  this.DaysOfWeek = [
    'Dom',
    'Lun',
    'Mar',
    'Mie',
    'Jue',
    'Vie',
    'Sab'
  ];

  // Months, stating on January
  this.Months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ];

  // Set the current month, year
  var d = new Date();

  this.currMonth = d.getMonth();
  this.currYear = d.getFullYear();
  this.currDay = d.getDate();

  this.Holidays = ["2021-01-01","2021-01-11","2021-03-22","2021-04-01","2021-04-02","2021-05-01","2021-05-17","2021-06-07","2021-06-14","2021-07-05","2021-07-20","2021-08-07","2021-08-16","2021-10-18","2021-11-01","2021-11-15","2021-12-08","2021-12-25","2022-01-01","2022-01-10","2022-03-21","2022-04-14","2022-04-15","2022-05-01","2022-05-30","2022-06-20","2022-06-27","2022-07-04","2022-07-20","2022-08-07","2022-08-15","2022-10-17","2022-11-07","2022-11-14","2022-12-08","2022-12-25"];

};

// ugly hack to find the holidays, will improve it later
Cal.prototype.isAHoliday = function(year, month, day) {
  if (month < 10) {
    month = '0' + month;
  }

  if (day < 10) {
    day = '0' + day;
  }

  if (this.Holidays.includes(year + '-' + month + '-' + day)) {
    console.log('foo');
    return true;
  }

  return false;

}

// Goes to next month
Cal.prototype.nextMonth = function() {
  if ( this.currMonth == 11 ) {
    this.currMonth = 0;
    if ( this.currYear == 2021 ) {
      this.currYear = 2022;
    } else {
      this.currYear = 2021;
    }
  }
  else {
    this.currMonth = this.currMonth + 1;
  }
  this.showcurr();
};

// Goes to previous month
Cal.prototype.previousMonth = function() {
  if ( this.currMonth == 0 ) {
    this.currMonth = 11;
    if ( this.currYear == 2021 ) {
      this.currYear = 2022;
    } else {
      this.currYear = 2021;
    }
  }
  else {
    this.currMonth = this.currMonth - 1;
  }
  this.showcurr();
};

// Show current month
Cal.prototype.showcurr = function() {
  this.showMonth(this.currYear, this.currMonth);
};

// Show month (year, month)
Cal.prototype.showMonth = function(y, m) {

  var d = new Date()
  // First day of the week in the selected month
  , firstDayOfMonth = new Date(y, m, 1).getDay()
  // Last day of the selected month
  , lastDateOfMonth =  new Date(y, m+1, 0).getDate()
  // Last day of the previous month
  , lastDayOfLastMonth = m == 0 ? new Date(y-1, 11, 0).getDate() : new Date(y, m, 0).getDate();

  var html = '<table class="calendar">';

  // Write selected month and year
  html += '<thead><tr>';
  html += '<td colspan="7" class="calendar">' + this.Months[m] + ' ' + y + '</td>';
  html += '</tr></thead>';


  // Write the header of the days of the week
  html += '<tr class="calendar days">';
  for(var i=0; i < this.DaysOfWeek.length;i++) {
    html += '<td class="calendar">' + this.DaysOfWeek[i] + '</td>';
  }
  html += '</tr>';

  // Write the days
  var i=1;
  do {

    var dow = new Date(y, m, i).getDay();

    // If Sunday, start new row
    if ( dow == 0 ) {
      html += '<tr class="calendar">';
    }
    // If not Sunday but first day of the month
    // it will write the last days from the previous month
    else if ( i == 1 ) {
      html += '<tr class="calendar">';
      var k = lastDayOfLastMonth - firstDayOfMonth+1;
      for(var j=0; j < firstDayOfMonth; j++) {
        html += '<td class="calendar not-current">' + k + '</td>';
        k++;
      }
    }

    // Write the current day in the loop
    var chk = new Date();
    var chkY = chk.getFullYear();
    var chkM = chk.getMonth();
    var chkD = chk.getDay();

    if (this.isAHoliday(this.currYear, this.currMonth + 1, i)) {
      html += '<td class="calendar holiday">' + i + '</td>';
    } else if ( dow == 0) {
      html += '<td class="calendar sunday">' + i + '</td>';
    } else if (chkY == this.currYear && chkM == this.currMonth && i == this.currDay) {
      html += '<td class="calendar today">' + i + '</td>';
    } else {
      html += '<td class="calendar normal">' + i + '</td>';
    }

    // If Saturday, closes the row
    if ( dow == 6 ) {
      html += '</tr>';
    }
    // If not Saturday, but last day of the selected month
    // it will write the next few days from the next month
    else if ( i == lastDateOfMonth ) {
      var k=1;
      for(dow; dow < 6; dow++) {
        html += '<td class="calendar not-current">' + k + '</td>';
        k++;
      }
    }

    i++;
  }while(i <= lastDateOfMonth);

  // Closes table
  html += '</table>';

  // Write HTML to the div
  document.getElementById(this.divId).innerHTML = html;
};

// On Load of the window
window.onload = function() {

  // Start calendar
  var c = new Cal("divCal");            
  c.showcurr();

  // Bind next and previous button clicks
  getId('btnNext').onclick = function() {
    c.nextMonth();
  };
  getId('btnPrev').onclick = function() {
    c.previousMonth();
  };
}

// Get element by id
function getId(id) {
  return document.getElementById(id);
}