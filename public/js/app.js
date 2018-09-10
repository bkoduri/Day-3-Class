var dashboardApp=new Vue({
  el:'#dashboard',
  data: {
  "name" : "Tapestry",
  "short_description": "Build a visualization layer for the project dashboard",
  "start_date" : "2018-07-01",
  "target_date" : "2018-11-03",
  "budget" : "4950000",
  "spent" : "3456700",
  "projected_spend": "4740500",
  "weekly_effort_target": 400,
  tasks:[
  {
    "id": 1,
    "title": "Build UI",
    "type" : "Story",
    "size" : "M",
    "team" : "Noble Carrots",
    "status": "Started",
    "start_date": "2018-08-02",
    "close_date": null,
    "hours_worked":90,
    "perc_complete": 95,
    "current_sprint" : true
  },
  {
    "id": 2,
    "title": "Update unit tests",
    "type" : "Story",
    "size" : "L",
    "team" : "MS Why Us",
    "status": "Closed",
    "start_date": "2018-07-15",
    "close_date": "2018-08-1",
    "hours_worked": 40,
    "perc_complete": 100,
    "current_sprint" : true
  },
  {
    "id": 3,
    "title": "Write middleware",
    "type" : "Epic",
    "size" : "XL",
    "team" : "California Dream",
    "status": "Open",
    "start_date": null,
    "close_date": null,
    "hours_worked": 0,
    "perc_complete": 0,
    "current_sprint" : true
  },
  {
    "id": 4,
    "title": "Completion % not saving",
    "type" : "Bug",
    "size" : "XS",
    "team" : "Luke's Parents",
    "status": "Open",
    "start_date": "2018-07-29",
    "close_date": "",
    "hours_worked": 27,
    "perc_complete": 80,
    "current_sprint" : false
  }
]
},


  computed: {
    days_left:function() {
       return moment(this.target_date).diff(moment(), 'days')
    },
    pretty_target_date: function () {
      return this.pretty_date(this.target_date)
    }
  },
  methods:  {
    pretty_date: function (d) {
      return moment(d).format('l')
    },
    pretty_currency: function (val) {
      if (val < 1e3) {
        return '$ ' + val
      }

      if (val < 1e6) {
        return '$ ' + (val/1e3).toFixed(1) + ' k'
      }

      return '$ ' + (val/1e6).toFixed(1) + ' M'
    },
    complete_class: function(task) {
      if (task.perc_complete == 100 ) {
        return 'alert-success'
      }
      if (task.current_sprint && task.hours_worked == 0 ) {
        return 'alert-warning'
      }
    }
  }
}
)
