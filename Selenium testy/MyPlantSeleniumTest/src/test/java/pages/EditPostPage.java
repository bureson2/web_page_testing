package pages;

import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.openqa.selenium.support.ui.Select;

import static org.openqa.selenium.support.PageFactory.initElements;

public class EditPostPage {

    private WebDriver webDriver;
    private JavascriptExecutor js;

    public EditPostPage(WebDriver webDriver) {
        this.webDriver = webDriver;
        initElements(webDriver, this);
    }

    @FindBy(xpath = "//*[@id=\"title\"]")
    WebElement title_input;

    @FindBy(xpath = "//*[@id=\"body\"]")
    WebElement body_input;

    @FindBy(xpath = "//*[@id=\"cat_id\"]")
    WebElement category_dropdown;

    @FindBy(xpath = "/html/body/div/div/form/div/button")
    WebElement submit_button;

    @FindBy(xpath = "/html/body/div/div/form/div/h2")
    WebElement editTitle;

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
        return editTitle;
    }

    public void clearInputs(){
        title_input.clear();
        body_input.clear();
    }
}
