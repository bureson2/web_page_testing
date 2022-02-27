package pages;

import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;

import static org.openqa.selenium.support.PageFactory.initElements;

public class HomePage {
    private WebDriver webDriver;

    @FindBy(xpath = "/html/body/header/div/div/nav/a[1]")
    WebElement register_button;

    @FindBy(xpath = "/html/body/header/div/div/nav/a[2]")
    WebElement login_button;

    @FindBy(xpath = "/html/body/div[3]/div/h1")
    WebElement introTitle;

    @FindBy(xpath = "/html/body/header/div/div/nav/a[5]")
    WebElement logout_button;

    @FindBy(xpath = "/html/body/header/div/div/nav/a[1]")
    WebElement create_button;

    @FindBy(xpath = "/html/body/header/div/div/nav/a[2]")
    WebElement posts_button;

    @FindBy(xpath = "/html/body/header/div/div/nav/a[3]")
    WebElement categories_button;

    @FindBy(xpath = "/html/body/header/div/div/nav/a[4]")
    WebElement learnMore_button;



    public HomePage(WebDriver webDriver) {
        this.webDriver = webDriver;
        initElements(webDriver, this);
    }


    public RegisterPage clickRegister(){
        register_button.click();
        return new RegisterPage(webDriver);
    }

    public LoginPage clickLogin(){
        login_button.click();
        return new LoginPage(webDriver);
    }

    public WebElement findIntroTitle(){
        return introTitle;
    }

    public void logout(){
        logout_button.click();
    }

    public CreatePage clickCreate(){
        create_button.click();
        return new CreatePage(webDriver);
    }

    public PostsPage clickPosts(){
        posts_button.click();
        return new PostsPage(webDriver);
    }

    public CategoriesPage clickCategories(){
        categories_button.click();
        return new CategoriesPage(webDriver);
    }

    public LearnMorePage clickLearnMore(){
        learnMore_button.click();
        return new LearnMorePage(webDriver);
    }
}
