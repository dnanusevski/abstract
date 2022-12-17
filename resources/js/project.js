class TemplateControl {
    constructor() {
        this.count = 1;
    }

    addTemplate() {
        if (this.count > 4) {
            alert("Max num of templates reached");
            return;
        }
        this.count++;
        let htmlAppend = "";
        let template = "template_" + this.count;
        let default_template_1 = "default_template_" + this.count;
        htmlAppend += `<br/>`;
        htmlAppend += `<label for="${template}">`;
        htmlAppend += `<span>Default</span>`;
        htmlAppend += `<input type="radio" id="${default_template_1}" name="default_tamplate" value="${template}">`;
        htmlAppend += `</label>`;
        htmlAppend += `<textarea name ="${template}">${template}</textarea>`;

        document.getElementById("mail_templates").innerHTML += htmlAppend;
    }
}
const templateControl = new TemplateControl();

if (document.getElementById("addTemplate")) {
    document.getElementById("addTemplate").onclick = function jsFunc() {
        templateControl.addTemplate();
    };
}

if (document.getElementById("send_mail")) {
    document.getElementById("send_mail").onclick = function jsFunc() {
        let template = document.getElementById("template").value;
        let driver = JSON.parse(document.getElementById("driver").value);
        let params = JSON.parse(document.getElementById("params").value);

        // console.log(template);
        //console.log(driver);
        // console.log(params);

        fetch("/api/send-mail", {
            method: "POST",
            body: JSON.stringify({
                driver: driver,
                template: template,
                params: params,
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8",
            },
        }).then((response) => response.json())
          .then((data) => console.log(data));
    };
}
