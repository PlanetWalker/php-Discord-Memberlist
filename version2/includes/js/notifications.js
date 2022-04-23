class notifications {
  static notify(content) {
    $.createNotification({
      content: content,
      duration: 10000
    });
  }
    static send(header, footer) {
    this.notify("<i class='fa fa-info-circle'></i> <div class='notification-content'> <div class='notification-header'>" + header + "</div> " + footer + "</div>");
  }
  static success(header, footer) {
    this.notify("<i class='fa fa-thumbs-up notification-success'></i> <div class='notification-content'> <div class='notification-header'>" + header + "</div> " + footer + "</div>");
  }
  static fail(header, footer) {
    this.notify("<i class='fa fa-exclamation-triangle notification-error'></i> <div class='notification-content'> <div class='notification-header'>" + header + "</div> " + footer + "</div>");
  }
    
  static warning(header, footer) {
    this.notify("<i class='fa fa-exclamation-triangle notification-warning'></i> <div class='notification-content'> <div class='notification-header'>" + header + "</div> " + footer + "</div>");
  }
  static info(header, footer) {
    this.notify("<i class='fa fa-info-circle notification-info'></i> <div class='notification-content'> <div class='notification-header'>" + header + "</div> " + footer + "</div>");
  }
  static loading(header, footer) {
    this.notify("<div class='spinner-border notification-info' role='status'> <span class='sr-only'>Loading...</span> </div> <div class='p-2 notification-content'> <div class='notification-header'>" + header + "</div> " + footer + "</div>");
  }
}

