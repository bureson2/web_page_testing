package pages;

import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;

import static org.openqa.selenium.support.PageFactory.initElements;

public class LearnMorePage {

    WebDriver webDriver;
    private JavascriptExecutor js;

    @FindBy(xpath = "/html/body/section/article[1]/div[2]/a")
    WebElement anthurium_button;

    @FindBy(xpath = "/html/body/section/article[2]/div[2]/a")
    WebElement echinopsis_cactus_button;

    @FindBy(xpath = "/html/body/section/article[3]/div[2]/a")
    WebElement viola_button;

    @FindBy(xpath = "/html/body/section/article[4]/div[2]/a")
    WebElement azalea_button;

    @FindBy(xpath = "/html/body/section/article[5]/div[2]/a")
    WebElement geranium_button;

    @FindBy(className = "Learn_intro_title")
    WebElement learnMore_title;

    public LearnMorePage(WebDriver webDriver) {
        this.js = (JavascriptExecutor) webDriver;
        this.webDriver = webDriver;
        initElements(webDriver, this);
    }

    public WikiPage clickLinkAnthurium(){
        while(!anthurium_button.isDisplayed()){
            js.executeScript("window.scrollBy(0,document.body.scrollHeight)");
        }
        anthurium_button.click();
        return new WikiPage(webDriver);
    }

    public WikiPage clickLinkEchinopsis(){
        js.executeScript("window.scrollTo(0, 0);");
        while(!echinopsis_cactus_button.isDisplayed()){
            js.executeScript("window.scrollBy(0,document.body.scrollHeight)");
        }
        echinopsis_cactus_button.click();
        return new WikiPage(webDriver);
    }

    public  WikiPage clickLinkViola(){
        js.executeScript("window.scrollTo(0, 0);");
        while(!viola_button.isDisplayed()){
            js.executeScript("window.scrollBy(0,document.body.scrollHeight)");
        }
        viola_button.click();
        return new WikiPage(webDriver);
    }

    public  WikiPage clickLinkAzalea(){
        js.executeScript("window.scrollTo(0, 0);");
        while(!azalea_button.isDisplayed()){
            js.executeScript("window.scrollBy(0,document.body.scrollHeight)");
        }
        azalea_button.click();
        return new WikiPage(webDriver);
    }

    public  WikiPage clickLinkGeranium(){
        js.executeScript("window.scrollTo(0, 0);");
        while(!geranium_button.isDisplayed()){
            js.executeScript("window.scrollBy(0,document.body.scrollHeight)");
        }
        geranium_button.click();
        return new WikiPage(webDriver);
    }

    public WebElement getTitle(){
        return learnMore_title;
    }

    public HomePage goToHomePage() {
        return new HomePage(webDriver);
    }
}
