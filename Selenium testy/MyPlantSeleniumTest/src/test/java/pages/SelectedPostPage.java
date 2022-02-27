package pages;

import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;

import static org.openqa.selenium.support.PageFactory.initElements;

public class SelectedPostPage {

    WebDriver webDriver;
    private JavascriptExecutor js;

    @FindBy(xpath = "/html/body/div[1]/h1")
    WebElement post_title;

    @FindBy(xpath = "/html/body/div[2]/div[2]")
    WebElement post_body;

    @FindBy(xpath = "/html/body/div[2]/div[1]/div[2]/a")
    WebElement edit_button;

    @FindBy(xpath = "/html/body/div[2]/div[1]/div[2]/form/input")
    WebElement delete_button;

    @FindBy(xpath = "//*[@id=\"name\"]")
    WebElement comment_name_field;

    @FindBy(xpath = "//*[@id=\"email\"]")
    WebElement comment_email_field;

    @FindBy(xpath = "//*[@id=\"body\"]")
    WebElement comment_body_field;

    @FindBy(css = ".comments .comment:last-child h3")
    WebElement comment_name;

    @FindBy(css = ".comments .comment:last-child p")
    WebElement comment_body;

    @FindBy(xpath = "/html/body/div[4]/form/button")
    WebElement submit_button;

    @FindBy(xpath = "/html/body/div[2]/div[2]")
    WebElement latestPostBody;

    public SelectedPostPage(WebDriver webDriver) {
        this.webDriver = webDriver;
        initElements(webDriver, this);
    }

    public EditPostPage clickEditPost() {
        edit_button.click();
        return new EditPostPage(webDriver);
    }

    public void clickDeletePost() {
        delete_button.click();
    }

    public WebElement postTitle(){
        return post_title;
    }

    public WebElement postBody(){
        return post_body;
    }

    public WebElement getLastCommentName() {
        return comment_name;
    }

    public WebElement getLastBody() {
        return comment_body;
    }

    public void fillOutForm(String name, String email, String body){
        comment_name_field.sendKeys(name);
        comment_email_field.sendKeys(email);
        comment_body_field.sendKeys(body);
    }

    public void clearInputs(){
        comment_name_field.clear();
        comment_email_field.clear();
        comment_body_field.clear();
    }

    public void sendForm() {
        submit_button.click();
    }

    public WebElement getLastElementBody(){
        return latestPostBody;
    }

}