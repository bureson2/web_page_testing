package pages;

import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.openqa.selenium.support.ui.Select;

import static org.openqa.selenium.support.PageFactory.initElements;

public class CreatePage {

    private WebDriver webDriver;
    private JavascriptExecutor js;

    public CreatePage(WebDriver webDriver) {
        this.webDriver = webDriver;
        initElements(webDriver, this);
    }

    @FindBy(xpath = "//*[@id='title']")
    WebElement title_input;

    @FindBy(xpath = "//*[@id=\"editor1\"]")
    WebElement body_input;

    @FindBy(xpath = "//*[@id=\"category\"]")
    WebElement category_dropdown;

    @FindBy(xpath = "/html/body/div/div/form/div/div/button")
    WebElement submit_button;

    @FindBy(xpath = "/html/body/div/div/form/div/h2")
    WebElement createTitle;

    public Select getSelectOptions() {
        return new Select(category_dropdown);
    }

    public void fillOutForm(String title, String body, String value){
        title_input.sendKeys(title);
        body_input.sendKeys(body);
        getSelectOptions().selectByVisibleText(value);
    }

    public void sendForm() {
        submit_button.click();
    }

    public WebElement findCreateTitle(){
        return createTitle;
    }

    public HomePage goToHomePage() {
        return new HomePage(webDriver);
    }

    public void clearInputs(){
        title_input.clear();
        body_input.clear();
    }
}
