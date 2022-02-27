import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.FindBy;
import pages.*;

import java.util.concurrent.TimeUnit;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.openqa.selenium.support.PageFactory.initElements;

public class TestMods {

    static WebDriver webDriver;

    @FindBy(xpath = "/html/body/header/div/div/nav/button")
    WebElement mode_button;

    String mode = "light";

    @BeforeAll
    public static void SetUp(){

        System.setProperty("webdriver.chrome.driver", "C:/Users/bures/OneDrive/Plocha/MyPlantSeleniumTest/src/main/resources/chromedriver.exe");
        webDriver = new ChromeDriver();
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/");

    }

    public void changeMode() {

        mode_button.click();
        mode = webDriver.getPageSource().contains("dark") ? "dark" : "light";
    }

    @Test
    public void modsTest() {

        initElements(webDriver, this);
        assertEquals("light", mode);

        HomePage homePage = new HomePage(webDriver);
        WebElement introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());
        changeMode();
        assertEquals("dark", mode);

        RegisterPage registerPage = homePage.clickRegister();
        changeMode();
        assertEquals("light", mode);

        homePage = registerPage.goToHomePage();
        LoginPage loginPage = homePage.clickLogin();
        changeMode();
        assertEquals("dark", mode);

        loginPage.fillOutForm("Chereolenlka", "TS1ahoj!");
        loginPage.sendForm();
        webDriver.manage().timeouts().implicitlyWait(2, TimeUnit.SECONDS);
        introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());
        changeMode();
        assertEquals("light", mode);

        CreatePage createPage = homePage.clickCreate();
        changeMode();
        assertEquals("dark", mode);

        homePage = createPage.goToHomePage();
        changeMode();
        assertEquals("light", mode);

        PostsPage postsPage = homePage.clickPosts();
        changeMode();
        assertEquals("dark", mode);

        homePage = postsPage.goToHomePage();
        changeMode();
        assertEquals("light", mode);

        LearnMorePage learnMorePage = homePage.clickLearnMore();
        changeMode();
        assertEquals("dark", mode);

        homePage = learnMorePage.goToHomePage();
        changeMode();
        assertEquals("light", mode);

        CategoriesPage categoriesPage = homePage.clickCategories();
        changeMode();
        assertEquals("dark", mode);

        homePage = categoriesPage.goToHomePage();
        changeMode();
        assertEquals("light", mode);

        homePage.logout();
        changeMode();
        assertEquals("dark", mode);
        changeMode();
        assertEquals("light", mode);
        changeMode();
        assertEquals("dark", mode);

    }
}

