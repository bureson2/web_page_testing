package pages;

import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;

import static org.openqa.selenium.support.PageFactory.initElements;

public class WikiPage {
    private WebDriver webDriver;

    @FindBy(id = "firstHeading")
    WebElement pageTitle;

    public WikiPage(WebDriver webDriver) {
        this.webDriver = webDriver;
        initElements(webDriver, this);
    }

    public WebElement findPageTitle(){
        return pageTitle;
    }
}
