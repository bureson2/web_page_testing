package pages;

import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;

import static org.openqa.selenium.support.PageFactory.initElements;

public class LoginPage {

    private WebDriver webDriver;

    @FindBy(id = "username")
    WebElement username_input;

    @FindBy(id = "password")
    WebElement password_input;

    @FindBy(xpath = "/html/body/div/div/div/form/div/button")
    WebElement submit_button;

    @FindBy(xpath = "/html/body/div/div/div/form/div/h1")
    WebElement signinTitle;

    public LoginPage(WebDriver webDriver) {
        this.webDriver = webDriver;
        initElements(webDriver, this);
    }

    public void fillOutForm(String username, String password){
        username_input.sendKeys(username);
        password_input.sendKeys(password);
    }

    public void clearInputs(){
        username_input.clear();
        password_input.clear();
    }

    public void sendForm() {
        submit_button.click();
    }

    public WebElement findSigninTitle(){
        return signinTitle;
    }
}
