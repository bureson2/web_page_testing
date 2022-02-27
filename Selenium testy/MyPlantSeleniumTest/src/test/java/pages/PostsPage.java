package pages;

import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;

import static org.openqa.selenium.support.PageFactory.initElements;

public class PostsPage {

    private JavascriptExecutor js;
    WebDriver webDriver;

    @FindBy(xpath = "/html/body/div[1]/div/h1")
    WebElement postTitle;

    @FindBy(xpath = "/html/body/div[2]/p/a")
    WebElement readMoreButton;

    @FindBy(xpath = "//a[@class ='pagination-link' and text()='‹ First']")
    WebElement firstPage;

    @FindBy(xpath = "//a[@class ='pagination-link' and text()='Last ›']")
    WebElement lastPage;

    @FindBy(className = "pagination_links")
    WebElement pagination;

    @FindBy(css = "div.pagination_links > strong" )
    WebElement numberOfLastPage;


    public PostsPage(WebDriver webDriver) {
        this.js = (JavascriptExecutor) webDriver;
        this.webDriver = webDriver;
        initElements(webDriver, this);
    }

    public WebElement findPostsTitle(){
        return postTitle;
    }

    public SelectedPostPage clickReadMore() {
        readMoreButton.click();
        return new SelectedPostPage(webDriver);
    }

    public void clickLastPage(){
        while(!lastPage.isDisplayed()){
            js.executeScript("window.scrollBy(0,document.body.scrollHeight)");
        }
        lastPage.click();
    }

    public void clickFirstPage(){
        while(!firstPage.isDisplayed()){
            js.executeScript("window.scrollBy(0,document.body.scrollHeight)");
        }
        firstPage.click();
    }

    public boolean isLastOnPage(){
        while(!pagination.isDisplayed()){
            js.executeScript("window.scrollBy(0,document.body.scrollHeight)");
        }
        if(pagination.getText().contains("Last")){
            return true;
        } return false;
    }

    public boolean isFirstOnPage(){
        while(!pagination.isDisplayed()){
            js.executeScript("window.scrollBy(0,document.body.scrollHeight)");
        }
        if(pagination.getText().contains("First")){
            return true;
        } return false;
    }

    public int countArticles(){
        js.executeScript("window.scrollTo(0, 0);");
        while(!pagination.isDisplayed()){
            js.executeScript("window.scrollBy(0,document.body.scrollHeight)");
        }
        int numberOfPages = Integer.parseInt(numberOfLastPage.getText());
        int postsOnLastPage = webDriver.findElements(By.className("post_index")).size();
        int result = (numberOfPages - 1) * 3 + postsOnLastPage; //++++++
        return result;
    }

    public HomePage goToHomePage() {
        return new HomePage(webDriver);
    }
}
