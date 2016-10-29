define({ "api": [
  {
    "type": "PUT",
    "url": "/todo",
    "title": "PUT List Todo",
    "name": "PutTodo",
    "group": "Todo",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>to unique ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "application/controllers/Todo.php",
    "groupTitle": "Todo"
  }
] });
