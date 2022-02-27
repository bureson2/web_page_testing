package pages;

import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;

import static org.openqa.selenium.support.PageFactory.initElements;

public class RegisterPage {
    private WebDriver webDriver;
    private JavascriptExecutor js;

    @FindBy(id = "name")
    WebElement name_input;

    @FindBy(id = "email")
    WebElement email_input;

    @FindBy(id = "username")
    WebElement username_input;

    @FindBy(id = "password")
    WebElement password_input;

    @FindBy(id = "password2")
    WebElement getPasswordAgain_input;

    @FindBy(xpath = "/html/body/div/div/form/div/button")
    WebElement submit_button;

    @FindBy(xpath = "/html/body/div/div/form/div/h1")
    WebElement signupTitle;

    public RegisterPage(WebDriver webDriver) {
        this.webDriver = webDriver;
        this.js = (JavascriptExecutor) webDriver;
        initElements(webDriver, this);
    }

    public void fillOutForm(String name, String email, String username, String password, String passwordAgain){
        name_input.sendKeys(name);
        email_input.sendKeys(email);
        username_input.sendKeys(username);
        password_input.sendKeys(password);
        getPasswordAgain_input.sendKeys(passwordAgain);
    }

    public void clearInputs(){
        name_input.clear();
        email_input.clear();
        username_input.clear();
        password_input.clear();
        getPasswordAgain_input.clear();
    }

    public void sendForm() {
        js.executeScript("window.scrollTo(0, document.body.scrollHeight)");
        submit_button.click();
    }

    public WebElement findSignupTitle(){
        return signupTitle;
    }

    public HomePage goToHomePage() {
        return new HomePage(webDriver);
    }

}
